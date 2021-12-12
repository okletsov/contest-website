<?php

$lastUpdatedSql = "SELECT max(convert_tz(bjl.finish_timestamp , 'UTC', 'Europe/Kiev')) as kiev_runtime from background_job_log bjl;";
$crRawOngoingSql = "SELECT * FROM web_cr_raw_ongoing";
$crWinningStrickSql = "SELECT * FROM web_cr_winning_strick order by place;";
$crBiggestOddSql = "SELECT * FROM web_cr_biggest_odd order by place;";
$futureBetsSql = "SELECT * from web_future_bets;";
$dopStavkiSql = "SELECT * FROM web_dop_stavki order by nickname;";
$checkRulesSql = "SELECT * FROM web_check_rules;";

?>