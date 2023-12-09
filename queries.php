<?php

$lastUpdatedSql = "SELECT * from web_last_data_update";

// Home
$crRawOngoingSql = "SELECT * FROM web_cr_raw_ongoing";
$crRawOngoing2ndMonthSql = "SELECT * FROM web_cr_raw_ongoing_2nd_month";
$crWinningStrickSql = "SELECT * FROM web_cr_winning_strick order by place;";
$crBiggestOddSql = "SELECT * FROM web_cr_biggest_odd order by place;";
$futureBetsSql = "SELECT * from web_future_bets;";
$inPlayBetsSql = "SELECT * from web_in_play_bets;";
$recentBetsSql = "SELECT * from web_recent_bets;";
$dopStavkiSql = "SELECT * FROM web_dop_stavki order by nickname;";
$checkRulesSql = "SELECT * FROM web_check_rules;";

// Rating
$ratingLiveSql = "SELECT * FROM web_rating_live;";
$ratingStaticSql = "SELECT * FROM web_rating_static;";

?>