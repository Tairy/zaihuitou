<?php
date_default_timezone_set('Asia/Shanghai');

echo date("Y-m-d", strtotime('friday next week',time()));
// 
// echo date('Y-n-d',strtotime('Monday'));
// echo date('Y-n-d',strtotime('next Friday'));
// echo date('Y-n-d',strtotime('last Monday'));
// echo date('Y-n-d',strtotime('Friday'));