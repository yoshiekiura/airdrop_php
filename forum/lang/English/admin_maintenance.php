<?php

// Language definitions used in admin_maintenance.php
$lang_admin_maintenance = array(

'Maintenance head'				=>	'Forum maintenance',
'Rebuild index subhead'			=>	'Rebuild search index',
'Rebuild index info'			=>	'If you\'ve added, edited or removed posts manually in the database or if you\'re having problems searching, you should rebuild the search index. For best performance, you should put the forum in %s during rebuilding. <strong>Rebuilding the search index can take a long time and will increase server load during the rebuild process!</strong>',
'Posts per cycle label'			=>	'Posts per cycle',
'Posts per cycle help'			=>	'The number of posts to process per pageview. E.g. if you were to enter 300, three hundred posts would be processed and then the page would refresh. This is to prevent the script from timing out during the rebuild process.',
'Starting post label'			=>	'Starting post ID',
'Starting post help'			=>	'The post ID to start rebuilding at. The default value is the first available ID in the database. Normally you wouldn\'t want to change this.',
'Empty index label'				=>	'Empty index',
'Empty index help'				=>	'Select this if you want the search index to be emptied before rebuilding (see below).',
'Rebuild completed info'		=>	'Once the process has completed, you will be redirected back to this page. If you are forced to abort the rebuild process, make a note of the last processed post ID and enter that ID+1 in "Starting post ID" when/if you want to continue ("Empty index" must not be selected).',
'Rebuild index'					=>	'Rebuild index',
'Rebuilding search index'		=>	'Rebuilding search index',
'Rebuilding index info'			=>	'Rebuilding index. This might be a good time to put on some coffee :-)',
'Processing post'				=>	'Processing post <strong>%s</strong> …',
'Click here'					=>	'Click here',
'Javascript redirect failed'	=>	'Automatic redirect unsuccessful. %s to continue …',
'Posts must be integer message'	=>	'Posts per cycle must be a positive integer value.',
'Days must be integer message'	=>	'Days to prune must be a positive integer value.',
'No old topics message'			=>	'There are no topics that are %s days old. Please decrease the value of "Days old" and try again.',
'Posts pruned redirect'			=>	'Posts pruned. Redirecting …',
'Prune head'					=>	'Prune',
'Prune subhead'					=>	'Prune old posts',
'Days old label'				=>	'Days old',
'Days old help'					=>	'The number of days "old" a topic must be to be pruned. E.g. if you were to enter 30, every topic that didn\'t contain a post dated less than 30 days old would be deleted.',
'Prune sticky label'			=>	'Prune sticky topics',
'Prune sticky help'				=>	'When enabled, sticky topics will also be pruned.',
'Prune from label'				=>	'Prune from forum',
'All forums'					=>	'All forums',
'Prune from help'				=>	'The forum from which you want to prune posts.',
'Prune info'					=>	'Use this feature with caution. <strong>Pruned posts can never be recovered.</strong> For best performance, you should put the forum in %s during pruning.',
'Confirm prune subhead'			=>	'Confirm prune posts',
'Confirm prune info'			=>	'Are you sure that you want to prune all topics older than %s days from %s (%s topics).',
'Confirm prune warn'			=>	'WARNING! Pruning posts deletes them permanently.',

);
