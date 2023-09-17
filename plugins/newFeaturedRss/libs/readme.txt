
Simple example:

<?php
	include('class.rss.php');
	$rss = new rss('utf-8');

	$rss->channel('RSStitle', 'http://www.yoursite.com', 'Description of RSS channel');
	$rss->language('en-us');
	$rss->copyright('Copyright by yourSiteName 2006');
	$rss->managingEditor('email@yoursite.com');
	$rss->category('CategoryName');

	$rss->startRSS();

	for($i = 1; $i < 10; $i++){
	    $rss->itemTitle('News ' . $i);
	    $rss->itemLink('http://www.yoursite.com/news.php?id=' . $i);
	    $rss->itemDescription('This is short news deswcription number ' . $i);
	    $rss->itemAuthor('email@yoursite.com');
	    $rss->itemGuid('http://www.yoursite.com/news.php?id=' . $i);
	    $rss->itemSource('YourSiteName', 'http://www.yoursite.com/rss/rss.xml');

	    $rss->addItem();
	}

	echo $rss->RSSdone();

?>

Prototypes and description:
---------------------------

Full documentation of RSS 2.0 standard you can find at http://blogs.law.harvard.edu/tech/rss

Legends:
--------
 *R - required function
 *O - optional function
 = '' - optional parameter inside the function


- $rss = new rss($encoding = '');

- function channel($title, $link, $description);
  *R

- function language($language);
  *O

- function copyright($copyright);
  *O
  Copyright notice for content in the channel

- function managingEditor($managingEditor);
  *O
  Email address for person responsible for editorial content

- function webMaster($webMaster);
  *O
  Email address for person responsible for technical issues relating to channel

- function pubDate($pubDate);
  *O
  The publication date for the content in the channel
  All date-times in RSS conform to the Date and Time Specification of RFC 822

- function lastBuildDate($lastBuildDate);
  *O
  The last time the content of the channel changed

- function category($category, $domain = '');
  *O
  Specify one or more categories that the channel belongs to
  Follows the same rules as the function itemCategory();

- function cloud($domain, $port, $path, $registerProcedure, $protocol);
  *O
  Allows processes to register with a cloud to be notified of updates to the channel,
  implementing a lightweight publish-subscribe protocol for RSS feeds

- function ttl($ttl);
  *O
  ttl stands for time to live
  It's a number of minutes that indicates how long a channel can be cached before refreshing from the source

- function image($url, $title, $link, $width = '', $height = '', $description = '');
  *O
  Specifies a GIF, JPEG or PNG image that can be displayed with the channel

- function textInput($title, $description, $name, $link);
  *O
  Specifies a text input box that can be displayed with the channel

- function skipHours();
  *O
  function can take any numner of parameters
  See the specification for skipHours tag

- function skipDays();
  *O
  function can take any numner of parameters
  See the specification for skipDays tag

- function startRSS($path = '.', $filename = 'rss');
  *O
  function take path and filename for creating an XML file
  It has to be called after all aabove function but before any item function
  In default it will create rss.xml file in current directory


Item functions:
---------------

A channel may contain any number of item functions.
An item may represent a "story" much like a story in a newspaper or magazine
If so its description is a synopsis of the story, and the link points to the full story.
An item may also be complete in itself, if so, the description contains the text,
and the link and title may be omitted.
All elements of an item are optional, however at least one of title or description must be present.


- function itemTitle($title)
  *R / *O
  The title of the item

- function itemLink($link);
  *O
  The URL of the item

- function itemDescription($description);
  *R / *O
  The item synopsis

- function itemAuthor($author);
  *O
  Email address of the author of the item

- function itemCategory($category, $domain = '');
  *O
  Includes the item in one or more categories.
  It has one optional attribute, domain, a string that identifies a categorization taxonomy
  The value of the element is a forward-slash-separated string that identifies a hierarchic location in the indicated taxonomy.
  Processors may establish conventions for the interpretation of categories.
  You may include as many category elements as you need to, for different domains,
  and to have an item cross-referenced in different parts of the same domain.

- function itemComments($comments);
  *O
  URL of a page for comments relating to the item

- function itemEnclosure($enclosure);
  *O
  Describes a media object that is attached to the item

- function itemGuid($guid, $isPermaLink = '');
  *O
  A string that uniquely identifies the item
  If the guid element has an attribute named "isPermaLink" with a value of true,
  the reader may assume that it is a permalink to the item, that is, a url that can be opened in a Web browser,
  that points to the full item described by the <item> element

- function itemPubDate($pubDate);
  *O
  Indicates when the item was published

- function itemSource($source, $url);
  *O
  The RSS channel that the item came from

- function addItem();
  *R
  You place this function after all item functions.
  You can create unlimited number of items.

- function RSSdone();
  *R
  This is the last you write in your code

- function clearRSS();
  *R / *O
  You write this function if You want to create a new RSS channel without reinitializing the class









