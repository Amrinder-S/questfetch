<?php
$capabilities = array(
    'local/questfetch:viewcontent' => array(
        'captype' => 'write',
        'contextlevel' => CONTEXT_COURSE,
        'archetypes' => array(
            'teacher' => CAP_ALLOW,
        ),
    ),
);

$archetypes = array(
    'teacher' => CAP_ALLOW,
);
