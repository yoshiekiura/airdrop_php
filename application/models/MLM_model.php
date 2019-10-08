<?php
/**
 * Description of ConfigModal
 *
 * @author yakov
 */
class MLM_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function getValueWithKey($key) {
        $result = $this->db->select("value")
                ->from('tbl_config')
                ->where("config_key = '$key'")
                ->get()
                ->result();
            
        if (count($result) == 0)    return "";
        return $result [0]->value;
    }

    public function setValueWithKey($key, $value) {
        $result = $this->db->set('value', $value)
                ->where('config_key', $key)->update("tbl_config");
        return $result;
    }

    // supported countries
    public function getSupportedCountries(){
        $countries = $this->getValueWithKey('mlm_supported_countries');
        $array = json_decode($countries);
        return empty($array) ? [] : $array; //php array format
    }

    public function addNewCountry($country_code){
        $array = $this->getSupportedCountries();
        array_push($array, $country_code);
        $countries = json_encode($array);
        $this->setValueWithKey('mlm_supported_countries', $countries);
        return true;
    }

    public function isMLMCountry($country_code){
        if(strlen($country_code) != 2)
            return false;
        $countries = $this->getSupportedCountries();
        foreach($countries as $index => $country){
            if(strtolower($country) == strtolower($country_code))   return true;
        }
        return false;
    }

    public function calcCountryStatus($country_code){
        if(strlen($country_code) != 2)   return [
            "sigmaCommission" => '0',
            "sigmaPeople" => '0',
        ];
        $query = "SELECT SUM(mlm_commission) as sigmaCommission,
                         COUNT(user_id) as sigmaPeople
                  FROM airdrop_user_info
                  WHERE country_code = '$country_code'";

        $result = $this->db->query($query);
        if($result == false)    return [
            "sigmaCommission" => '0',
            "sigmaPeople" => '0',
        ];

        $result = $result->result()[0];

        return [
            "sigmaCommission" => empty($result->sigmaCommission) ? 0 : $result->sigmaCommission,
            "sigmaPeople" => empty($result->sigmaPeople) ? 0 : $result->sigmaPeople,
        ];
    }

    // public function isMLMUser($id){
    //     $countries = $this->getSupportedCountries();
    //     foreach($countries as $index => $country){
    //         if(strtolower($country) == strtolower($country_code))   return true;
    //     }
    //     return false;
    // }

    // referral tree
    public function getTreeHeightLimit(){
        $res = $this->getValueWithKey('mlm_tree_height_limit');
        return $res;
    }

    public function getDirectChildrenLimit(){
        $res = $this->getValueWithKey('mlm_tree_direct_children_limit');
        return $res;
    }

    public function getLevelCommissions(){
        $res = $this->getValueWithKey('mlm_level_commissions');
        return json_decode($res); //php array
    }

    public function setLevelCommissions($commissions){
        $res = $this->setValueWithKey('mlm_level_commissions', json_encode($commissions));
        return $res; //raw json
    }

    public function getDirectChildren($parentID, $country_code, $maxCount){
        $children = [];

        if($parentID == 0)      return $children;
        $query ="SELECT tbl_users.user_id,
                        tbl_users.email,
                        tbl_users.username,
                        airdrop_user_info.mlm_commission
                 FROM tbl_users
                 JOIN airdrop_user_info ON (airdrop_user_info.user_id = tbl_users.user_id)
                 WHERE ref_id = $parentID
                 AND activated = 1
                 AND country_code = '$country_code'
                 LIMIT $maxCount";

        $result = $this->db->query($query);
        if($result == false)    return $children;
        // $resultArray = $result->result_array();
        // for($i = 0; $i < count($resultArray); $i++){
        //     array_push($children, $resultArray[$i]['user_id']);
        // }
        $children = $result->result();
        return $children;
    }

    public function genMLMTree($parentID, $country_code, $curLevel, $maxLevel, $commissions, $maxDirectChildren, &$tree){
        if($curLevel >= $maxLevel)  return;
        $children = $this->getDirectChildren($parentID, $country_code, $maxDirectChildren);
        // no children
        if(count($children) === 0)       return;
        if(!isset($tree[$curLevel]))
            $tree[$curLevel] = [];
        foreach($children as $key => $child){
            array_push($tree[$curLevel], $child);
        }
        foreach($children as $key => $child){
            $this->genMLMTree($child->user_id, $country_code, $curLevel + 1, $maxLevel, $commissions, $maxDirectChildren, $tree);
            // array_push($tree, $child);
        }
    }

    public function getReportbyUser($id, $country_code, &$refPeopleCount, &$refCommission, &$refResult){

        $maxLevel = $this->getTreeHeightLimit(); // 3
        $maxDirectChildren = $this->getDirectChildrenLimit(); // 3
        $levelCommissions = $this->getLevelCommissions(); // [10, 5, 3]
        $resTree = [];
        $resCount = 0;
        $this->genMLMTree($id, $country_code, 0, $maxLevel, $levelCommissions, $maxDirectChildren, $resTree);
        
        $BASECOMMISSION = 100;
        
        $refPeopleCount = 0;
        $refCommission = $BASECOMMISSION;
        $refResult = [];

        foreach($resTree as $level => $children){
            foreach($children as $index => $child){
                $child->level = $level;
                $child->rate = $levelCommissions[$level];
                $child->commission = $BASECOMMISSION / 100 * $levelCommissions[$level];
                array_push($refResult, $child);
                $refPeopleCount++;
                $refCommission += $child->commission;
            }
        }
    }

    public function updateUserMLMStatus($user_id, $peopleCount, $commission){
        if(empty($peopleCount))     $peopleCount = 0;
        if(empty($commission))     $commission = 0;
        $query = "UPDATE airdrop_user_info SET mlm_people_cnt = $peopleCount WHERE user_id = $user_id";
        $result = $this->db->query($query);
        $query = "UPDATE airdrop_user_info SET mlm_commission = $commission WHERE user_id = $user_id";
        $result = $this->db->query($query);
    }
}
?>