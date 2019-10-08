<?php require_once 'header.php'; ?>
<style>

.button-frame {
    position: relative;
    display: block;
    height: auto;
    margin: 0 auto !important;
    width: 100%;
    float: left;
    background-color: #a19b90;
}
#buttons {
position:relative;
 top:0;
 left:0;
 bottom:0;
 display: flex;
 flex-direction: row;
 justify-content: space-evenly;
 text-align: center;
 margin: 6% auto !important;
}
#buttons a {
	background-color: #000000;
	border-radius: 10px;
    box-shadow: 0px 2px 5px 0px rgba(53, 166, 220, 0.88);
	font-size: 1.2rem;
    line-height: 45px;
	display:block;
	width:300px;
}
.wrapping
{display: block;
width:100%;
overflow:hidden;
background-color: #024c4f;
margin-top: 100px;}

.translation-desc{
    text-align:  center;
    color:  white;
    margin-bottom: 30px;
	padding:10px;
}



@media screen and (max-width: 768px) {
    .wrapping #buttons a {
        background-color: black;
        border-radius: 15px;
        font-size: 1.2rem;
        color: white;
        display: block;
        line-height: 45px;
        width: 300px;
        text-align: center;
        margin: 10px auto;
    }
    .wrapping #buttons {
        position: relative;
        top: 0;
        left: 0;
        bottom: 0;
        display: flex;
        flex-wrap: inherit;
        flex-direction: column;
        justify-content: space-evenly;
        text-align: center;
        margin: 6% auto !important;
    }
}


</style>
<div class="wrapping">
<div class="button-frame">
<div id="buttons">
<a href="wp/<?php if(!empty($_GET['lo'])) { echo $_GET['lo']; } else { echo '
en'; }?>/sr.pdf"><img src="/assets/socialremit-logo.png">SocialRemit</a>
<a href="wp/<?php if(!empty($_GET['lo'])) { echo $_GET['lo']; } else { echo 'en'; }?>/okmoney.pdf"><img src="/assets/okaymoney-logo1.png">OkayMoney Transfer</a>
<a href="wp/<?php if(!empty($_GET['lo'])) { echo $_GET['lo']; } else { echo 'en'; }?>/s1w.pdf"><img src="/assets/stock1wisev1.png">Stock1Wise (S1W)</a>
</div>
    <div class="translation-desc"><?= $t['translation_desc'] ?></div>
</div>
</div>
<?php require_once 'footer.php'; ?>
