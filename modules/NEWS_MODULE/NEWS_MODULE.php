<?php
	$MODULE_NAME = "NEWS_MODULE";

	//Setup
	bot::event("setup", "$MODULE_NAME/setup.php");

	//News
    bot::event("logOn", "$MODULE_NAME/news_logon.php", "none", "Sends a tell with news to players logging in");
	bot::command("", "$MODULE_NAME/news.php", "news", "all", "Show News");
	bot::subcommand("", "$MODULE_NAME/news.php", "news (.+)", "guildadmin", "news", "Add News");
	bot::subcommand("", "$MODULE_NAME/news.php", "news del (.+)", "guildadmin", "news", "Delete a Newsentry");

	//Set admin and user news
	bot::command("", "$MODULE_NAME/set_news.php", "privnews", "rl", "Set news that are shown on privjoin");
	bot::command("", "$MODULE_NAME/set_news.php", "adminnews", "mod", "Set adminnews that are shown on privjoin");
	bot::addsetting($MODULE_NAME, "news", "no", "hide", "Not set.");
	bot::addsetting($MODULE_NAME, "adminnews", "no", "hide", "Not set.");

	//Help files
	bot::help($MODULE_NAME, "news", "news.txt", "guild", "How to use news");
	bot::help($MODULE_NAME, "priv_news", "priv_news.txt", "raidleader", "Set Private channel News");
?>