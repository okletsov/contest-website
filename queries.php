<?php

$lastUpdatedSql = "SELECT max(convert_tz(bjl.finish_timestamp , 'UTC', 'Europe/Kiev')) as kiev_runtime from background_job_log bjl;";

// Home
$crRawOngoingSql = "SELECT * FROM web_cr_raw_ongoing";
$crRawOngoing2ndMonthSql = "SELECT * FROM web_cr_raw_ongoing_2nd_month";
$crWinningStrickSql = "SELECT * FROM web_cr_winning_strick order by place;";
$crBiggestOddSql = "SELECT * FROM web_cr_biggest_odd order by place;";
$futureBetsSql = "SELECT * from web_future_bets;";
$recentBetsSql = "SELECT * from web_recent_bets;";
$dopStavkiSql = "SELECT * FROM web_dop_stavki order by nickname;";
$checkRulesSql = "SELECT * FROM web_check_rules;";

// Rating
$ratingLiveSql = "SELECT * FROM web_rating_live;";
$ratingStaticSql = "SELECT * FROM web_rating_static;";

?>