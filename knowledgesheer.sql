-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 03, 2019 at 04:52 AM
-- Server version: 10.1.41-MariaDB-cll-lve
-- PHP Version: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `knowledgesheer`
--

-- --------------------------------------------------------

--
-- Table structure for table `blog_comments`
--

CREATE TABLE `blog_comments` (
  `comment_id` int(11) NOT NULL,
  `comment_post_id` int(11) NOT NULL,
  `comment_author` varchar(255) NOT NULL,
  `comment_email` varchar(255) NOT NULL,
  `comment_content` text NOT NULL,
  `comment_status` varchar(255) NOT NULL,
  `comment_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `blog_likes`
--

CREATE TABLE `blog_likes` (
  `id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `blog_likes`
--

INSERT INTO `blog_likes` (`id`, `post_id`, `user_id`) VALUES
(1, 1, 1),
(2, 2, 5);

-- --------------------------------------------------------

--
-- Table structure for table `blog_posts`
--

CREATE TABLE `blog_posts` (
  `post_id` int(11) NOT NULL,
  `post_category_id` int(11) NOT NULL,
  `post_sub_cat_id` int(11) NOT NULL,
  `post_title` varchar(255) NOT NULL,
  `post_author` varchar(255) NOT NULL,
  `post_date` date NOT NULL,
  `post_image` text NOT NULL,
  `post_content` text NOT NULL,
  `post_tags` varchar(255) NOT NULL,
  `post_description` text NOT NULL,
  `post_comment_count` varchar(255) NOT NULL,
  `post_status` varchar(255) NOT NULL,
  `post_slug` varchar(255) NOT NULL,
  `likes` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `blog_posts`
--

INSERT INTO `blog_posts` (`post_id`, `post_category_id`, `post_sub_cat_id`, `post_title`, `post_author`, `post_date`, `post_image`, `post_content`, `post_tags`, `post_description`, `post_comment_count`, `post_status`, `post_slug`, `likes`) VALUES
(1, 2, 3, '9 Great Reasons to Use a Planner', 'ashwin', '2019-09-15', 'Img_09-15-2019_1568575798_pexels-photo-1020323 (1).jpeg', '<p>Planners are a great way to get organized, scheduling and make use of your valuable time to the fullest. You just have to give fifteen to twenty minutes of your day or maybe more that depends on your planner type to write everything you want to do on that day or that week or achieve in the coming month. It is very easy to forget, and forgetting things can cost you big time. So, you should make sure not to forget afterward by writing it down.</p><p>So, here are the 9 great reasons to use a planner.</p><ul>	<li>	<p><strong>A planner is portable.&nbsp;</strong>You can carry yours too and from school/office in your backpack.</p>	</li>	<li>	<p><strong>A planner never forgets.</strong> Unlike the human head, it has no holes in it, so things can&#39;t fall out.</p>	</li></ul><ul>	<li>	<p><strong>A planner prevents scheduling problems.&nbsp;</strong>Did a friend invite you to go skating two Saturdays from now? Check your planner before saying yes. Uh-oh, that&#39;s the day of the track meet!</p>	</li>	<li>	<p><strong>A planner keeps all of your important information in one place.</strong>&nbsp;No more paper scraps, sticky notes, or inky, smeared reminders written on your hand.</p>	</li>	<li>	<p><strong>A planner reminds you of what you need to do and when.&nbsp;</strong>You will no longer need parents, teachers, or other adults in your life. (Just kidding.)</p>	</li>	<li>	<p><strong>A planner helps you keep track of important projects.</strong>&nbsp;Write down everything you need to do, and you are&nbsp;less likely to forget a task or a due date.</p>	</li></ul><ul>	<li>	<p><strong>A planner helps you reach your goals.&nbsp;</strong>Break down a big goal into smaller steps, write each step in your planner, finish one step at a time, and before you know it you&rsquo;re there.</p>	</li></ul><ul>	<li>	<p><strong>A planner can be whatever you want it to be.</strong>&nbsp;Yours might be a simple list of assignments, projects, and activities. Or it might include address book, lists of books you want to read and movies you want to see, your daily journal, notes about ideas you have, your hopes and dreams&hellip;. What else? It&rsquo;s up to you.</p>	</li></ul><ul>	<li>	<p><strong>A planner frees up valuable space in your brain.</strong>&nbsp;When you write down many things you need to remember, you don&rsquo;t actually need to remember them. You just need to remember&nbsp;<strong>one</strong>&nbsp;thing: to look at your planner.</p>	</li></ul><p>There are many different types of planners.</p><p><strong>Monthly view</strong>&nbsp;planners show a whole month on two pages (Not much writing room there). It is not used that popularly because of congestion, i.e. a whole month of work in just 2 pages, now that&rsquo;s too much. But you can use it as a summary of things you did in the past month or an overview of the things you have to do in the coming month.</p><p><strong>Weekly view</strong>&nbsp;planners show one week on two pages. This is the size that most people use. Well, obviously it gives more space to write some pointers or make a list of jobs or tasks you need to do in this week. It is more detailed than the monthly planner and focusses on the task of an overview.</p><p><strong>Two-page-per-day</strong>&nbsp;planners are great if you also like to use your planner as a journal or daily diary. Now, this is used by people who want to record their day in detail and in words. This type of planner mostly feels like writing a college assignment (Just kidding, but seriously!).</p><p>Some planners just have the days and dates, with blank lines and spaces for writing. Some look more like assignment notebooks, with subject names and boxes to check when you finish each assignment.</p><p>Some have places to write lists of things to take home and bring to school, weekly goals, long term projects, teacher and parent messages, and more.</p>', 'Planners, 9 Great Reasons to Use a Planner, time management, different types of planners', 'Planners are a great way to get organized, scheduling and make use of your valuable time to the fullest.', '', 'public', '9-great-reasons-to-use-a-planner', 1),
(2, 3, 4, 'How does startup funding works', 'Erebus', '2019-09-17', 'Img_09-17-2019_1568744274_funding.jpg', '<p>Every now and then we hear the word funding but what it&#39;s meaning and everything behind it.</p><p>First, let&#39;s assume that you want to start a company for setting up all the things, now you need some amount of money to make it happen for registration, for this, you take money from friends or family, this is known as the <strong>initial round of funding</strong> also known as seed funding.&nbsp;</p><p>Till now you and only one of your friends were the owners of 100% of the shares, but after the initial funding which was taken from your friend or family, &nbsp;now he/she will also have some equity in your company.&nbsp;</p><p>Now assume that you have taken $50,000 for the 20% of the company&rsquo;s shares, so, now your company has the value of $250,000 and after getting that money, let&rsquo;s say you worked for a year and used up all the money and now after the first year of your company, now you need more money to operate, up until now you&#39;ve made a beta of the product that you were working on and now looking for more funding like $1 million, for this, mostly you contact an <strong>Angel Investor or VC (Venture Capitalist)</strong>.</p><p><strong>Venture Capitalists</strong> are the people who work for venture capital firms that <strong>raise venture capital funds</strong>. They take other people&#39;s money and then they invest that money in new companies that are just starting up, it&rsquo;s just like a gamble.&nbsp;</p><p><strong>Angel Investors</strong> are individuals who professionally invest their own money into young companies. They are often the people who had successfully sold their own startup company many years ago and now they are looking to support early ventures.</p><p>Be it venture capitalists or angel investors, they see the team first in order to determine whether the team is competent and confident enough to make the idea work. And they also hear the idea on which the company is based, they also gauge the founders of their ability and whether they can dream big and after that, they might invest.&nbsp;</p><p>Now there is another thing called <strong>pre-money valuation</strong> and <strong>post-money valuation</strong>. The pre-money valuation is how your company is currently valued and the post-money valuation is your current valuation and the investment money you are looking to collect.</p><div class=\"text-center\"><figure class=\"image\"><img alt=\"Formula\" src=\"https://res.cloudinary.com/ashwinpandey/image/upload/v1568742748/Photo_from_Ashwin_Pandey.jpg\" /><figcaption>Formula to decide shares of investors.</figcaption></figure></div><p>Most of the time investors look for the low post-money valuation in order to get more shares for their money, and on the other hand, you want high post-money valuation in order to keep the larger share of the company&rsquo;s shares for yourself.&nbsp;</p><p>For example, you suggest your company&rsquo;s post-money valuation of $8 million, for the investors who are investing $1 million, then this would mean that 12.5% of the total of 100% of your company shares will go to them, but here, it is advisable for you to take investments from both types of investors.&nbsp;</p><p>You should take investments from both Angel Investors and Venture Capitalists because Venture Capitalists have more <strong>money</strong> and Angel Investors have more <strong>networks</strong> to grow your startup.</p><p>Now let&rsquo;s say that you&#39;ve taken $50,000 from an Angel Investor and $1 million from a Venture Capitalist which is a total of $1.5 million for the post-money valuation of $6 million. This means that both the investors own 25% of your entire company&rsquo;s shares.</p><p>Now, with new investors coming on board your shares will be diluted after the investments, now your cumulative share will only add up to 75% of the company&rsquo;s total shares. This dilution of shares happens proportionally (in most cases).&nbsp;</p><p>If things go well for your new company, you will raise more investments in upcoming years, which are known as <strong>Series B, Series C, Series D and so on</strong>. For each investment round, the company valuation will hopefully increase and each time your company takes a new investment from an investor, your shares will be further diluted.&nbsp;</p><p>After the stock splits, which then converts each and every single share that anyone holds, converts into multiple shares and hence your number of shares gets doubled or tripled every now and then with everyone else.&nbsp;</p><p>Now let&rsquo;s say, your new company is running nicely and aged 6 years and after completion of a number of rounds of fundings, now your investors want to sell their share, this is known as <strong>&quot;Exit&quot;</strong>.&nbsp;</p><p>There are usually two ways of exiting the company, one is to <strong>sell the shares</strong> to one of the big companies like Google, Facebook, Tesla, Amazon, etc and the other way is by <strong>offering your share to the stock market</strong>.&nbsp;</p><p>If you sell out to a big company, then your share will be transferred to that company who bought you and this is called <strong>Vesting of shares</strong>.&nbsp;</p><p>The process of selling the shares to share market is known as <strong>Initial Public Offering (IPO)</strong>. IPO is nothing but just a capital raise from the public.&nbsp;</p><p>Now, let&rsquo;s consider that you start the selling price of your shares from $64 for each share and till evening, the value raises to $70 per share in trading, due to stock split suited along the way, you are now holding $10 million worth of shares of your company, which means your personal wealth is over $700 million.</p><p>Having this much money, now you can enjoy it or invest it into other new startups and become an angel investor yourself.<br />&nbsp;</p>', 'How does startup funding works, understand funding, startup', 'Every now and then we hear the word funding but what it\'s meaning and everything behind it.', '', 'public', 'how-does-startup-funding-works', 1),
(3, 4, 5, 'Writing guidelines one should follow', 'ashwin', '2019-09-18', 'Img_09-18-2019_1568791642_writing.jpg', '<p dir=\"ltr\"><span style=\"line-height: 1.38;\"><span style=\"font-size: 11pt;\"><span style=\"font-family: Arial;\"><span style=\"color: #000000;\">Well, if you are reading this, then it is either you\'re starting to write or want to write or just curious. This post is mainly for the writers of Knowledge Sheer, but can be applicable to anyone.</span></span></span></span></p><p dir=\"ltr\"><span style=\"line-height: 1.38;\"><span style=\"font-size: 11pt;\"><span style=\"font-family: Arial;\"><span style=\"color: #000000;\">This is the basic guidelines one should follow when writing or posting a blog post. These parameters should be kept in mind, because they are also according to SEO perspective.</span></span></span></span></p><p dir=\"ltr\"><span style=\"line-height: 1.38;\"><span style=\"font-size: 11pt;\"><span style=\"font-family: Arial;\"><span style=\"color: #000000;\">Now, in order to write a blog, you should follow these guidelines for a good post. The first in the list is the title of the post.</span></span></span></span></p><h2>Title</h2><p dir=\"ltr\">Title of the post is a very important part of your post. It describes the purpose of the post, it indicates the reader with what they are going to read about in this post. They are the first impression many people will have of your page. So it is crucial to give a suitable title to your post.</p><p dir=\"ltr\">Now, in terms of search engine optimization, titles are the major factor in helping search engines like google understand what your page is about.</p><p dir=\"ltr\">Things you need to consider while writing a title are,</p><p dir=\"ltr\"><strong>1. You need to watch your title length</strong>, title should not be too long or too short.</p><p dir=\"ltr\"><strong>2. Try to avoid ALL CAPS titles.</strong></p><p dir=\"ltr\">Because they may become hard to read for search visitors which will result in low traffic and also restrict the number of characters Google will display.</p><p dir=\"ltr\"><strong>3. Watch the characters which take lot of space</strong>, for example, &ldquo;W&rdquo; takes more space than &ldquo;i&rdquo; or &ldquo;t&rdquo;.</p><p dir=\"ltr\"><strong>4. Don&rsquo;t overdo SEO keywords in the title.&nbsp;</strong></p><p dir=\"ltr\">You can make your title long or short, but you might run into trouble if you start stuffing keywords in your title.</p><p dir=\"ltr\">For example, &ldquo;Business Planners, Best Planners, Buy Planners, Planners for sale&rdquo;</p><p dir=\"ltr\">As the above example shows, avoid titles like that which are full of keywords.</p><p dir=\"ltr\"><strong>5. Give every page a unique title.</strong>&nbsp;</p><p dir=\"ltr\">Repeating the title may confuse the readers, so it is a good practice to keep them unique. In case, you are doing a series of posts which are a continuation of the one before, than simply add &ldquo;part-1&rdquo; or &ldquo;(1)&rdquo;, by doing this you are indicating that the content in this post is the continuation of another post, which also increases readability and understanding.</p><p dir=\"ltr\"><strong>6. Put important words first</strong> in the title while keeping it meaningful and readable.</p><h2 dir=\"ltr\">Featured Image</h2><p dir=\"ltr\">According to WordPress,</p><blockquote><p dir=\"ltr\">A featured image represents the contents, mood, or theme of a post or page.&nbsp; Posts and pages can have a single featured image, which many themes and tools can use to enhance the presentation of your site.</p></blockquote><p dir=\"ltr\">Featured images displayed on a blog post are represented as thumbnails and can vary in size depending upon the theme or environment of your website.</p><p dir=\"ltr\">Featured images are like the cover of a book, making the best first impression becomes very easy with the use of the featured image. One of the standout features relating to the use of featured images is that it brings structure and consistency to your blog.</p><p dir=\"ltr\">Now, let&rsquo;s see some best practices for using featured images.</p><p dir=\"ltr\"><strong>1. Size&nbsp;</strong></p><p dir=\"ltr\">Size of the featured image is one of the things you need to decide beforehand, and follow the same size (dimensions) for the rest of the posts in your website or blog.</p><p dir=\"ltr\">Here, on Knowledge Sheer, we use the image dimension for featured images is <strong>750 pixels x 350 pixels (i.e. 650 px in width and 400 px in height)</strong>. And the image takes the width of the container based on the device dimensions and adjust itself.</p><p dir=\"ltr\"><strong>2. Image Quality &amp; optimization (KB / MB)</strong></p><p dir=\"ltr\">All the featured images are usually large in size. So, it&rsquo;s best to go for a <strong>high-resolution image</strong> instead of the one that pixelates easily. Almost every blogger uses images from free stock image sites like pexels, unsplash, etc, and there are also some that hire designers to create unique featured images for each post.</p><p dir=\"ltr\">If you want a unique image and don&rsquo;t want to pay then you can make yourself by using online tools like <strong>Canva</strong>, which are really good to create images and designs.</p><p dir=\"ltr\">Now, It is good to use high-resolution images, but remember to optimize the image before uploading it. As high-resolution images take a lot of storage space and due to that size it takes a huge amount of time to load. So, it is best to <strong>optimize to around 25 KB to 50 KB</strong>, which is the most optimal.</p><p dir=\"ltr\">There are a lot of online tools available for reducing image size without losing much quality.</p><p dir=\"ltr\"><strong>3. Relevance</strong></p><p dir=\"ltr\">Featured images are meant to capture the essence of the blog post they are associated with. But finding a relevant image which goes with your post and fits the criteria mentioned above is too much of a pain.&nbsp;</p><p dir=\"ltr\">If you want unique featured images for your posts than you should hire a designer to create featured images. And if you want to create them by your own, then you can use <strong>Photoshop, GIMP, Illustrator and can also use Canva</strong> which is an online tool.&nbsp;</p><p dir=\"ltr\">Or if you want a readymade image which is also free to use without any copyright issues, then the websites like <strong>unsplash, pexels, freepik</strong> are the website to go to, they provide high quality images.</p><p dir=\"ltr\"><strong>4. Add &ldquo;alt&rdquo; attribute</strong></p><p dir=\"ltr\">It is highly advised to add alt attributes to your images, by doing this, if your image doesn&rsquo;t load then the alt attribute will be shown in its place. Alt attribute also helps in search engine optimization(SEO).</p><h2 dir=\"ltr\">Main Content</h2><p>Start with the main point of the post in order to give the reader an overall idea to what they are going to read and from SEO perspective use you focus word in the starting 10 to 15 words.</p><p><strong>Paragraphs</strong></p><p>The best and easiest way to turn off your audience from your post is to present them with a big wall of text that has few breaks and little white space.</p><p>Nowadays, it is expected that there will be short paragraphs on the blog posts because they look and feel easier to read. Short paragraphs allow readers to consume a huge chunk of text in a very efficient way and also helps maintain their focus.</p><p>Each paragraph should be of at most four to five lines or three sentences. It will make your post more readable. It is advised to use user-friendly words, which increases the readability of the posts.</p><p>Images in the middle of the posts</p><p>This is also an important part of the post. The main purpose of using images in your blog is to increase its appeal and boost the number of times it is viewed. Research on the Skyword content marketing platform suggests an average increase in blog views of 94% when a post includes images.</p><p>It is even better if the content is of type news and political stories, will receive an even greater boost in the number of views if they use an image.</p><p>Now the question arises that, how many should one use. Because there are many benefits to adding images to your blog, but having too many might backfire. Research suggests an <strong>average of 3.2 images per blog</strong> apart from the featured image and <strong>1 image per 350 words</strong> (approximately).</p><p>Image placement is also important, you can add images to your post, but there are different ways to display them. The first way in <strong>inline images</strong> in which your text flows around your image, <strong>block images</strong>, which has a space of its own and the text is above and below the image and can be aligned to the <strong>right, left, and center</strong> and they float the way the name suggests.</p><p>And also provide alt attribute to these images as well.</p><p><strong>Word count</strong></p><p>Well, what do you do, when you open a post and find out that you have to scroll endlessly to read the whole content, &nbsp;which has what you need in detail but it&rsquo;s very big to read.</p><p>On the contrary, what do you do when you find the content too little to read, which will not be as detailed.&nbsp;</p><p>So, it is important to keep the word count in check as well, it is advised to keep the word count of your post to <strong>at least 800 words and at most 2000 words</strong>. If you have a huge amount of content, then you can just slice it up into parts and upload them accordingly.</p><p>And if you can show the estimated time the post will take the user to read then it is even better. It will indicate the reader beforehand that this post will take, for example, 4 minutes to read. And the reader will read it accordingly.</p><p><strong>Links</strong></p><p>In a website or a blog, there are <strong>two types of linking</strong>, first is <strong>internal links</strong>, and the second it <strong>external links</strong>. For a blog post, both of them are important.</p><p>Now, you might be thinking, from where will I get these links? Let us first understand those types of links in short.</p><ol><li><strong>Internal Links</strong> - It is a type of link which is from another post of your own website or blog which refers to that post. If you are using a term in the post you are writing and that term has its own post, then you can link that term with that post, and it will count as an internal link. You can also provide <strong>read more</strong> link to another post from your blog to keep the user on your website.</li><li><strong>External Links</strong> - They are the links which indicate to a post or website which is not from your own blog or website. They are also used to give <strong>credits</strong> or used for <strong>sponsored</strong> content. It is advised to give credits to the website or blog from where you took the reference for something. Basically, it is a link which takes your user out of your website to where that link is pointed.</li></ol><p>There is a common question that, where to use the internal link and where to use the external link?</p><p>In order to use an internal link, just provide or suggest links to other related posts of your own website for the readers to read.</p><p>And as for external links, you can use it to give credit to another website or blog for their image or content you are using in your own post.&nbsp;</p><p>While providing external, it is good to make the link a &ldquo;nofollow&rdquo; link. But, according to Google&rsquo;s new guidelines, it introduced two more options apart from &ldquo;nofollow&rdquo;, and they are &ldquo;sponsored&rdquo; and &ldquo;ugc&rdquo;. rel = &ldquo;sponsored&rdquo; is for sponsored content and rel = &ldquo;ugc&rdquo; is for user-generated content. So, you can use them accordingly.</p><p>In order to use them in the external links, you need to add rel=&rdquo;nofollow&rdquo; (nofollow, ugc, sponsored) in the anchor tag.</p><p><strong>Ending off the post</strong></p><p>Always provide an ending to your post, most accurately write a short summary of 3 to 4 lines for the user to recap all the things they read in the post. And also provide some links to similar posts which the user might want to read.</p><p>All the points that are listed above are also used for search engine optimization, therefore you are hitting two birds with one stone.<br />&nbsp;</p>', 'Writing guidelines one should follow, writing basics, writing guidelines, knowledgesheer', 'This is the basic guidelines one should follow when writing or posting a blog post. These parameters should be kept in mind, because they are also according to SEO perspective.', '', 'public', 'writing-guidelines-one-should-follow', 0),
(4, 4, 7, 'Life is unpredictable is a truth or lie!', 'JayKay', '2019-09-22', 'Img_09-22-2019_1569140421_life-is-predictable.jpg', '<p dir=\"ltr\"><strong>Life is unpredictable &hellip;.. Is a Lie&nbsp;</strong></p><p dir=\"ltr\"><strong>Life is predictable it is the truth</strong></p><p dir=\"ltr\">How many of you relate to this term of unpredictable&hellip;</p><p dir=\"ltr\">When I speak of it&hellip; many of you will stick to the point that how can you be sure what life can give you&hellip;.</p><p dir=\"ltr\">There is a famous statement by an <strong>American actor Sylvester Stallone.</strong></p><blockquote><p dir=\"ltr\">No one will hit you harder than life itself. It doesn&rsquo;t matter how hard you hit back. It&rsquo;s about how much you can take, and keep fighting, how much you can suffer and keep Moving forward. That&rsquo;s how you win.</p><p dir=\"ltr\">-&nbsp;<strong>Sylvester Stallone</strong></p></blockquote><p dir=\"ltr\">I know that you might not relate to it. But let me explain to you how it goes&hellip;</p><p dir=\"ltr\">I had encounter one magical evangelism on this fact. First, it was very hard but now it has become one of my greatest pieces of advice. It all started with a Coffee mug filled with a bitter coffee (like a bitter truth).</p><p dir=\"ltr\">I was in a position of comfort waiting for someone. I was at her house on a couch with my office bag and a few scrap pages which I always prefer to have by my side to write something creepy. As time passed I got to know that there was a delay in her arrival. I was fussed and a little tired as I had waited a long to meet her. Finally, I started a chat with a person who was completely stranger to me.</p><p dir=\"ltr\">She was like a witch of Clash Royale (If you can relate). A complete phantom who walks into complete silent which can destroy you with a fraction of second if it goes close to it. It was completely horrifying and awkward to talk but finally, she breaks the ice.</p><p dir=\"ltr\">We had all the formalities and discover the truth which was lying in her head. We speak about life where I comment &ldquo;Life is so unpredictable, it does not give a second chance&rdquo;.</p><p dir=\"ltr\">She replied &ldquo;No it&rsquo;s always predictable&rdquo; &hellip;.&nbsp; (There was complete reticent all over)</p><p dir=\"ltr\">After increasing the size of my courage in 10x time I asked her out why so&hellip;?</p><p dir=\"ltr\">She told the secret which I was going to change my life forever&hellip;&hellip;&hellip;.</p><p dir=\"ltr\">She told me about her recent tragedies which she had gone through. It was a very rough patch for her but there was a wave of wisdom which was come for my heart to terrify me.&nbsp; She began how she falls in love with a guy who seems to love her (Actually he was not). Their relation was going well until the day arrived when there was no materialistic provision form the <strong>witch (my strange friend)</strong>.&nbsp;</p><p dir=\"ltr\">There comes the tsunami of truth... In which all lies, fake feelings get drowned.</p><p dir=\"ltr\">But it was not shocking for the witch to realize it because she was getting the hints&hellip;.</p><p dir=\"ltr\">A sign &hellip;.. An image of truth &hellip;&hellip; A symptom&hellip;&hellip;.</p><p dir=\"ltr\">Which she says it as a Signs from one&rsquo;s life&hellip;.</p><p dir=\"ltr\">Here comes when predictability makes an ingress in us. And we hold it like a real substance.</p><p dir=\"ltr\">There are always hints or signs which life gives you before any good or bad happening was her words.</p><p dir=\"ltr\">It thought how it&rsquo;s possible&hellip;..&nbsp;</p><p dir=\"ltr\">It was a very simple thing which was right in front of me but I didn&rsquo;t catch it as others must have done the same. I evaluate my whole like the reel of a movie and I find out that it was always joining me with the fact that life is predictable. It had always given me the signs. It had always provided me with the provision when there was call for&hellip;.&nbsp;</p><p dir=\"ltr\">And it has always deprived me of my asset (to be called as my wealth, health and beloved ones) when there was endowment&hellip;&nbsp;&nbsp;</p><p dir=\"ltr\">Precious things are always stored in the treasure</p><p dir=\"ltr\">As they need to be guarded against theft&nbsp;</p><p dir=\"ltr\">And offered to the deserving one&hellip;</p><p dir=\"ltr\">Maybe this is life for me&nbsp;</p><p dir=\"ltr\">Very predictable and very simple to understand regardless of its complexity.</p><p dir=\"ltr\"><span style=\"color:#e74c3c\">Never forget this truth&nbsp;</span></p><p dir=\"ltr\"><span style=\"color:#e74c3c\">Life is unpredictable &hellip;.. Is a Lie&nbsp;</span></p><p dir=\"ltr\"><span style=\"color:#e74c3c\">Life is predictable it is truth&hellip;.</span></p>', 'Life is unpredictable is a truth or lie, ', 'Precious things are always stored in the treasure\r\nAs they need to be guarded against theft \r\nAnd offered to the deserving one…\r\nMaybe this is life for me \r\nVery predictable and very simple to understand regardless of its complexity.\r\n\r\nNever forget this truth \r\nLife is unpredictable ….. Is a Lie \r\nLife is predictable it is truth…', '', 'public', 'life-is-unpredictable-is-a-truth-or-lie', 0),
(5, 4, 10, 'Why Space is Dark?', 'Erebus', '2019-09-24', 'Img_09-24-2019_1569317558_dark-sky.jpg', '<p><span style=\"font-weight: 400;\">As we know that the Earth is surrounded by the atmosphere. During the day the sun light passes through the atmosphere, and because of that the sunlight gets scattered off in all directions and as a result, we see the blue sky in the day time and at night there are no light that&rsquo;s why there is dark .&nbsp;</span></p><p><span style=\"font-weight: 400;\">If you were on the Moon, which has no atmosphere, the sky would be black at both nights and days. Here is the picture of moon from <strong>Apollo mission</strong>,</span></p><p><span style=\"font-weight: 400;\"><img class=\"img-fluid\" style=\"display: block; margin-left: auto; margin-right: auto;\" src=\"https://res.cloudinary.com/ashwinpandey/image/upload/v1569317302/moon.jpg\" alt=\"Image of moon during Apollo Mission\" /></span></p><p><span style=\"font-weight: 400;\">But then the question arises why the space is dark after having so many stars?</span></p><p><span style=\"font-weight: 400;\">The reason is the Universe is from somewhere around <strong>15 Billion years</strong> old and that means we can only see objects as far away as the distance light can travel in 15 billion years.&nbsp;</span></p><p><span style=\"font-weight: 400;\">The lights from farther away than that has not yet had time to reach us and so can&rsquo;t contribute to making the sky bright.</span></p><p><span style=\"font-weight: 400;\">Another reason is the universe kept expanding and according to the <strong>Doppler Effect</strong> if two objects are moving away from each other then they are moving towards redshift which means there wavelength is kept increasing and it went beyond visible light spectrum and went to infrared spectrum. That&rsquo;s why NASA uses infrared camera to capture the image of stars and galaxies.</span></p>', 'Why Space is Dark, moon, Apollo mission', 'As we know that the Earth is surrounded by the atmosphere. During the day the sun light passes through the atmosphere', '', 'public', 'why-space-is-dark', 0),
(6, 1, 11, 'Difference between SQL and MySQL', 'ashwin', '2019-09-26', 'Img_09-26-2019_1569491953_Database.jpg', '<p><span style=\"font-weight: 400;\">SQL is the language that communicates with the database and MySQL is the medium which supports and uses SQL to show the data to the user.</span></p><p><span style=\"font-weight: 400;\">Let&rsquo;s start with their standard definitions,&nbsp;</span></p><h3><span style=\"font-weight: 400;\">SQL</span></h3><p><span style=\"font-weight: 400;\">It is pronounced as &ldquo;</span><strong><em>sequel</em></strong><span style=\"font-weight: 400;\">&rdquo; or &ldquo;<strong>S-Q-L</strong>&rdquo;.</span></p><p><span style=\"font-weight: 400;\">According to Wikipedia, SQL is a <strong>domain-specific language</strong> used in programming and designed for managing data held in a <strong>relational database management systems (RDBMS)</strong></span><span style=\"font-weight: 400;\"> or for stream processing in a relational data stream management system (RDSMS). It is particularly useful in handling structured data, i.e. data incorporating relations among entities and variables.</span></p><p><span style=\"font-weight: 400;\">It is language which provides you with all the data in a single command, you don\'t even have to provide an id, you don&rsquo;t even need to think or specify how to reach a record.</span></p><p><span style=\"font-weight: 400;\">All the commands which are written in order to retrieve data from the database are simple and straight-forward. It is the most basic means to communicate with your database. It helps you retrieve the data in a simple way.</span></p><p><span style=\"font-weight: 400;\">SQL is not the database itself, it is the language that <strong>communicates</strong> with the database.</span></p><h3><span style=\"font-weight: 400;\">MySQL</span></h3><p><span style=\"font-weight: 400;\">MySQL is an open-source <strong>relational database management system (RDBMS)</strong>.</span></p><p><span style=\"font-weight: 400;\">It can be said that MySQL is the <strong>front-end</strong> of our database. We can see all the records of our databases through MySQL. It is a piece of <strong>software</strong>.</span></p><p><span style=\"font-weight: 400;\">Now, there is a mis-conception among the people that MySQL is the database, but it&rsquo;s not. It is just a medium to see the data in our database or create a new database or delete one.</span></p><p><span style=\"font-weight: 400;\"><strong>MySQL itself uses SQL</strong> to process and show the records in the front and provide functionalities to communicate and manage the data in the database without writing any SQL command. It is just like an admin panel for databases.</span></p><p><span style=\"font-weight: 400;\">There are many relational database management systems like PostgreSQL, Microsoft SQL Server, etc. Just search on the internet and you will find hundreds of relational database management systems (RDBMS). But one thing is common in all of them is that they all use SQL as a basic language to interact with the database. There is a slight difference in their syntax, but not much.</span></p><p><span style=\"font-weight: 400;\">The advantages of these relational database management systems like MySQL is that they write the query for you and you don;t have to worry about learning SQL, but it&rsquo;s always good to learn it.</span></p>', 'sql vs mysql, difference between , difference between sql and mysql', 'SQL vs MySQL, SQL is the language that communicates with the database and MySQL is the medium which supports and uses SQL to show the data to the user.', '', 'public', 'difference-between-sql-and-mysql', 0),
(7, 2, 10, 'Rule of 21/90 - The Art to enrich your lifestyle', 'JayKay', '2019-09-27', 'Img_09-27-2019_1569573048_21_90 Rule.jpg', '<p>Learn the rules, so you know how to break them&hellip;</p><p>I know it may sound opposite. Rule are the principle which had been set for a particular reason. How many of you had a break up, Failed in exams or had been discourage by the life as everything is going wrong?</p><p>Its time for you to be the change.</p><p><strong>The rule 21/ 90 works on three funda&rsquo;s</strong></p><ol><li>It takes 21 straight days to build a habit</li><li>Continue the same for 90 days to become a lifestyle</li><li>Start again if you fail</li></ol><ul><li><strong>It takes 21 straight days to build be habit : </strong>If you want to achieve something in your life you need to make some goals. Goals are the efforts taken to achieve desired result. As I told you, you might be partaker of failure in life but this can be changed when you follow the rules. For example listening to personality development videos for 10 minutes daily can improve you gradually. And if you do this for 21 straight days there may be boost in the confidence. This how your days become fruitful and successful.</li></ul><ul><li><strong>Continue the same for 90 days to become a lifestyle : </strong>As you successfully execute your goals for 21 days it becomes a cake walk for you to make it your life style. This time you are not just ready, also determined for the results. Its becomes the part of you and your personality. Eventually you become the lord of your habits.</li></ul><ul><li><strong>Start again if you fail</strong> <strong>: </strong>It&rsquo;s a three step process. First two are in order and last one is crucial. In my life I followed those two step rigorously but failed and flipped over. But it makes the difference for me when I discovered that I need to try and start again. <strong>Start again if you fail</strong> is the key to the door if you really want to achieve something.&nbsp; &nbsp;</li></ul><p><em><span style=\"text-decoration: underline;\"><strong>Steps to do this</strong></span></em></p><ul><li><strong><u>Stay Positive and affirmative:</u>&nbsp; </strong>Stay positive and affirmative !...&nbsp;<br />I know it&rsquo;s very difficult to stay positive whole day long. But you can start with a little good things which happens with you or you noticed which are good. This becomes a booster for your goals and you remain positive towards your goal in a day.</li></ul><ul><li><strong><u>Write daily 3 important things you want to achieve :</u> </strong>Maintain a dairy or a note in your phone where you need to write 3 important things you need to achieve in a day. Make sure that whatever may your goal you divide it into small bite. As there is an old saying <strong>&ldquo;you cannot eat an elephant in one bite.&rdquo;</strong></li></ul><p>&nbsp;</p><ul><li><strong><u>Appreciate Yourself</u></strong><u>:</u> No one know you better than you &hellip;.<br />You are your own ruler. You need to appreciate yourself. People will only appreciate you when you know how to appreciate yourself. Its easy to get demoralize over the fall short of your goals. Its ok you might not achieve all you want in a day but at least you had cover the major. Don&rsquo;t loose hope be positive and grateful for small happy things.</li></ul><ul><li><strong><u>Never give up</u></strong><u>:</u> As I told you never give up even if you fail, start again. Doesn&rsquo;t matter how many time you fail. Restart your goals and start working on it again.</li></ul><p>I hope you find my blog meaningful and interesting. I would request you to kindly share with your friends and Family so that they can be happy by 21/90 rule. Also give me your valuable feedback for the same.</p>', '#21/90 #Staypositive, #appreciateyourself, #nevergiveup, #knowledgesheer', 'The rule 21/ 90 works on three funda’s\r\n\r\nIt takes 21 straight days to build a habit\r\nContinue the same for 90 days to become a lifestyle\r\nStart again if you fail', '', 'public', 'rule-of-2190-the-art-to-enrich-your-lifestyle', 0),
(8, 4, 7, 'Second Chance', 'JayKay', '2019-09-28', 'Img_09-28-2019_1569647841_Second Chance to Love you.jpg', '<p style=\"text-align: center;\"><em>When I saw you, I felt</em></p><p style=\"text-align: center;\"><em>You are not the one who will matter</em></p><p style=\"text-align: center;\"><em>But we were meant together</em></p><p style=\"text-align: center;\"><strong><em>A Second chance, a chance to change</em></strong></p><p style=\"text-align: center;\">&nbsp;</p><p style=\"text-align: center;\"><em>As night comes</em></p><p style=\"text-align: center;\"><em>Life takes turn</em></p><p style=\"text-align: center;\"><em>I talked to you, listened to your mourns</em></p><p style=\"text-align: center;\"><em>My heart melts</em></p><p style=\"text-align: center;\"><em>You cried to hard</em></p><p style=\"text-align: center;\"><em>Even I can\'t control</em></p><p style=\"text-align: center;\"><em>That day I understood</em></p><p style=\"text-align: center;\"><em>We were meant together</em></p><p style=\"text-align: center;\"><strong><em>A Second chance, a chance to love you</em></strong></p><p style=\"text-align: center;\">&nbsp;</p><p style=\"text-align: center;\">We were meant together</p><p style=\"text-align: center;\">A Second chance</p><p style=\"text-align: center;\">Time to embrace</p><p style=\"text-align: center;\">And receive some grace</p><p style=\"text-align: center;\"><span style=\"font-size: 10pt;\">- Jay Kay</span></p><p style=\"text-align: left;\">To understand this poem do read the below story...</p><p><strong>I hugged her tightly...</strong></p><p><strong>My Love my mother</strong></p><p>It was very irritating to see her always nagging in my life. Not minding her own business and just interrupting me all the time. But it was fine until that night when everything had changed.</p><p>As a matter of fact, I had changed a much and came to a verge where I gonna Blast from inside out. It was very dismal to lose my mother. I was broken, hurt and little depressed. It feels like life has taken my chance of living.</p><p>But she came and changed my life. I am not talking about my Mother (the real one). I am talking about her. She is a person who was very irritating and was taking my space to be specific to the place of my mother. I never wanted her. But it was a second chance for both of us.</p><p>&nbsp;That night I was tired but not in a mood to go to bed early. I forcefully tried to sleep due to my daily early routine and woke up within an hour. When I see her awake.</p><p>I know there was something unsaid in her heart... There was a tiding of waves which can be seen in her eyes... There was a sea of sorrow with no shore in her heart.</p><p>I thought let&rsquo;s take her to walk and talk with her. When She told that she needs me which I understood later. She knows that I had lost my mother and don\'t want to give a chance to any other to take her (my real mother) place. But the truth... The Second chance... Was ready to hit me when I hear her.</p><p>She told me that her husband left her and had two sons who died long ago. She sees me as a second chance.</p><p>A new Son i.e. me, whom life has gifted her. Hearing this my heart melted and I cried... From the bottom of my heart, I cried and received my new Mother who also cried.</p><p>We both hugged each other and I understand the real meaning of second chance. I hugged her tightly...</p><p><strong>My Love my mother.</strong></p>', '#secondchance #love #meanttogether', 'When I saw you, I felt\r\n\r\nYou are not the one who will matter\r\n\r\n But we were meant together\r\n\r\nA Second chance, a chance to change', '', 'public', 'second-chance', 0),
(9, 2, 3, '8 Planner Tips and Tricks', 'ashwin', '2019-09-29', 'Img_09-29-2019_1569763068_planner.jpg', '<p>If you just bought a planner and made a resolution to use it from now and make good use of it then there are some planner tips and tricks that are listed below.</p><p>These planner tips and tricks are very useful and handy if you practice them.</p><p>If you have questions about why do we need a planner? or what they are used for? Then please go ahead and read <a title=\"9 great reasons to use a planner\" href=\"http://knowledgesheer.com/blog_post/1/9-great-reasons-to-use-a-planner\" target=\"_blank\" rel=\"noopener\">9 great reasons to use a planner</a>.</p><ol><li>If you are extra busy with homework and activities, use a <strong>daily planner</strong>. If you&rsquo;re not so busy, use a <strong>weekly planner</strong>.</li><li>When you first get your planner, spend time checking it out. Decide how you will use it. Where will you write long-term assignments? After-school activities? How will you keep track of your goals so you are sure to reach them? <strong>Personalize</strong> your planner. Make it your own.</li><li>Write in your <strong>planner in pencil, not ink</strong>. That way, when things change, you can erase them instead of crossing them out.</li><li>Mark really important events and due dates with a <strong>highlighter or sick-on stars</strong>.</li><li><strong>Use highlighters or colored pencils</strong> for different subjects or types of activities.</li><li>Remember that all work and no play makes life dull, so be sure to <strong>leave room for fun times</strong>, relaxing times, and special times with friends and family. Write those in your planner, too.</li><li><strong>Check your planner first thing every morning</strong>. You&rsquo;ll know what the day will bring.</li><li><strong>Check your planner last thing every night</strong>. You&rsquo;ll go to sleep feeling ready for tomorrow.</li></ol>', 'planner tips and tricks, uses of planner, types of planners', 'If you just bought a planner and made a resolution to use it from now and make good use of it then there are some planner tips and tricks that are listed below.', '', 'public', '8-planner-tips-and-tricks', 0);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `cat_id` int(11) NOT NULL,
  `cat_title` text NOT NULL,
  `cat_description` text NOT NULL,
  `cat_image` text NOT NULL,
  `cat_slug` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`cat_id`, `cat_title`, `cat_description`, `cat_image`, `cat_slug`) VALUES
(1, 'Technology', '', 'Img_cat_09-15-2019_1568566801_blurred-background-coffee-cup-contemporary-908284.jpg', 'technology'),
(2, 'Human Foundation ', '', 'ph-100x100.png', 'human-foundation'),
(3, 'Finance', '', 'Img_cat_09-17-2019_1568745527_finance.jpg', 'finance'),
(4, 'Word Scribble', '', 'Img_cat_09-22-2019_1569141207_words-scribble.jpg', 'word-scribble'),
(5, 'News', '', 'Img_cat_10-03-2019_1570086707_.', 'news');

-- --------------------------------------------------------

--
-- Table structure for table `quotes`
--

CREATE TABLE `quotes` (
  `quote_id` int(11) NOT NULL,
  `quote_image` text NOT NULL,
  `quote_date` date NOT NULL,
  `quote_content` text NOT NULL,
  `quote_hashtags` text NOT NULL,
  `quote_category` text NOT NULL,
  `quote_author` text NOT NULL,
  `likes` int(11) NOT NULL,
  `dislikes` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `quotes`
--

INSERT INTO `quotes` (`quote_id`, `quote_image`, `quote_date`, `quote_content`, `quote_hashtags`, `quote_category`, `quote_author`, `likes`, `dislikes`) VALUES
(1, 'Img_quote_09-15-2019_1568572641_WhatsApp Image 2019-08-28 at 9.51.26 AM.jpeg', '2019-09-15', 'This is the <a target=\'_blamk\' href=\'quote_search.php?q_search=first\'>#first</a> <a target=\'_blamk\' href=\'quote_search.php?q_search=quote\'>#quote</a> post for testing.', 'first, quote, ', '1', 'ashwin', 0, 0),
(2, 'Img_quote_09-16-2019_1568650724__Wonder is the beginning of wisdom_.jpg', '2019-09-16', 'start wondering <a target=\'_blamk\' href=\'quote_search.php?q_search=wisdom\'>#wisdom</a> <a target=\'_blamk\' href=\'quote_search.php?q_search=wonder\'>#wonder</a>', 'wisdom, wonder, ', '1', 'Erebus', 0, 0),
(3, 'Img_quote_09-18-2019_1568788657_quote-1.jpg', '2019-09-18', '<a target=\'_blamk\' href=\'quote_search.php?q_search=FallInLove\'>#FallInLove</a>', 'FallInLove, ', '2', 'ashwin', 0, 0),
(4, 'Img_quote_09-19-2019_1568875772_FB_IMG_1568875675492.jpg', '2019-09-19', '<a target=\'_blamk\' href=\'quote_search.php?q_search=poem\'>#poem</a> \r\nYour <a target=\'_blamk\' href=\'quote_search.php?q_search=love\'>#love</a> is <a target=\'_blamk\' href=\'quote_search.php?q_search=great\'>#great</a>', 'poem, love, great, ', '2', 'ashwin', 0, 0),
(5, 'Img_quote_09-22-2019_1569138557_quote-post-edited.jpg', '2019-09-22', 'All I want...\r\nlisten to your story\r\n#grassland <a target=\'_blamk\' href=\'quote_search.php?q_search=stars\'>#stars</a> <a target=\'_blamk\' href=\'quote_search.php?q_search=ourstory\'>#ourstory</a> <a target=\'_blamk\' href=\'quote_search.php?q_search=AllIwant\'>#AllIwant</a> <a target=\'_blamk\' href=\'quote_search.php?q_search=knowledgesheer\'>#knowledgesheer</a>', 'stars, ourstory, AllIwant, knowledgesheer, ', '', 'JayKay', 0, 0),
(6, 'Img_quote_09-22-2019_1569181304_20190921215843.jpg', '2019-09-22', '<a target=\'_blamk\' href=\'quote_search.php?q_search=cheerful\'>#cheerful</a> <a target=\'_blamk\' href=\'quote_search.php?q_search=\'>#</a> leader', 'cheerful, , ', '', 'Erebus', 0, 0),
(7, 'Img_quote_09-24-2019_1569298389_IMG-20190919-WA0007.jpg', '2019-09-24', '<a target=\'_blamk\' href=\'quote_search.php?q_search=got\'>#got</a> <a target=\'_blamk\' href=\'quote_search.php?q_search=chaos\'>#chaos</a> <a target=\'_blamk\' href=\'quote_search.php?q_search=\'>#</a> life', 'got, chaos, , ', '', 'Erebus', 0, 0),
(8, 'Img_quote_09-24-2019_1569308722_quote2019-09-24at12.jpg', '2019-09-24', '<a target=\'_blamk\' href=\'quote_search.php?q_search=educate\'>#educate</a> <a target=\'_blamk\' href=\'quote_search.php?q_search=yourself\'>#yourself</a> <a target=\'_blamk\' href=\'quote_search.php?q_search=knowledgesheer\'>#knowledgesheer</a>', 'educate, yourself, knowledgesheer, ', '', 'ashwin', 0, 0),
(9, 'Img_quote_09-24-2019_1569309059_20190924123920.jpg', '2019-09-24', '<a target=\'_blamk\' href=\'quote_search.php?q_search=work\'>#work</a> <a target=\'_blamk\' href=\'quote_search.php?q_search=hard\'>#hard</a> <a target=\'_blamk\' href=\'quote_search.php?q_search=respect\'>#respect</a> <a target=\'_blamk\' href=\'quote_search.php?q_search=others\'>#others</a>', 'work, hard, respect, others, ', '', 'Erebus', 0, 0),
(10, 'Img_quote_09-24-2019_1569316498_Photo from Jayezh.', '2019-09-24', 'It\'s I in me \r\nI am not perfect , I am simple \r\n#Iinme <a target=\'_blamk\' href=\'quote_search.php?q_search=wordsmith\'>#wordsmith</a> <a target=\'_blamk\' href=\'quote_search.php?q_search=simple\'>#simple</a> <a target=\'_blamk\' href=\'quote_search.php?q_search=human\'>#human</a> <a target=\'_blamk\' href=\'quote_search.php?q_search=knowledgesheer\'>#knowledgesheer</a>', 'wordsmith, simple, human, knowledgesheer, ', '', 'JayKay', 0, 0),
(11, 'Img_quote_09-24-2019_1569324532_the mantra of success is, to not look for the mantra -kunal shah.jpg', '2019-09-24', '<a target=\'_blamk\' href=\'quote_search.php?q_search=mantra\'>#mantra</a> <a target=\'_blamk\' href=\'quote_search.php?q_search=success\'>#success</a>', 'mantra, success, ', '', 'Erebus', 0, 0),
(12, 'Img_quote_09-28-2019_1569643804_Work Rule.jpeg', '2019-09-28', '<a target=\'_blamk\' href=\'quote_search.php?q_search=Workrule\'>#Workrule</a> <a target=\'_blamk\' href=\'quote_search.php?q_search=dontstop\'>#don\'tstop</a> <a target=\'_blamk\' href=\'quote_search.php?q_search=life\'>#life</a> <a target=\'_blamk\' href=\'quote_search.php?q_search=universe\'>#universe</a> <a target=\'_blamk\' href=\'quote_search.php?q_search=Knowledgesheer\'>#Knowledgesheer</a>', 'Workrule, dontstop, life, universe, Knowledgesheer, ', '', 'JayKay', 0, 0),
(13, 'Img_quote_09-30-2019_1569833836_new-quote.jpg', '2019-09-30', '<a target=\'_blamk\' href=\'quote_search.php?q_search=religion\'>#religion</a> <a target=\'_blamk\' href=\'quote_search.php?q_search=thoughts\'>#thoughts</a>', 'religion, thoughts, ', '', 'ashwin', 0, 0),
(14, 'Img_quote_10-01-2019_1569926338_20191001160506.jpg', '2019-10-01', '<a target=\'_blamk\' href=\'quote_search.php?q_search=knowledgesheer\'>#knowledgesheer</a> <a target=\'_blamk\' href=\'quote_search.php?q_search=change\'>#change</a> <a target=\'_blamk\' href=\'quote_search.php?q_search=life\'>#life</a> and <a target=\'_blamk\' href=\'quote_search.php?q_search=world\'>#world</a>', 'knowledgesheer, change, life, world, ', '', 'ashwin', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `quote_categories`
--

CREATE TABLE `quote_categories` (
  `quote_cat_id` int(11) NOT NULL,
  `quote_cat_title` varchar(255) NOT NULL,
  `quote_cat_desc` text NOT NULL,
  `quote_cat_image` text NOT NULL,
  `quote_cat_slug` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `quote_categories`
--

INSERT INTO `quote_categories` (`quote_cat_id`, `quote_cat_title`, `quote_cat_desc`, `quote_cat_image`, `quote_cat_slug`) VALUES
(1, 'First Quote Category', 'First Quote Category', 'ph-100x100.png', 'first-quote-category'),
(2, 'Second Category', 'Second Quote Category', 'ph-100x100.png', 'second-category');

-- --------------------------------------------------------

--
-- Table structure for table `quote_likes`
--

CREATE TABLE `quote_likes` (
  `id` int(11) NOT NULL,
  `quote_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sub_categories`
--

CREATE TABLE `sub_categories` (
  `sub_cat_id` int(11) NOT NULL,
  `sub_cat_title` text NOT NULL,
  `parent_cat_id` int(11) NOT NULL,
  `sub_cat_description` text NOT NULL,
  `sub_cat_image` text NOT NULL,
  `sub_cat_slug` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sub_categories`
--

INSERT INTO `sub_categories` (`sub_cat_id`, `sub_cat_title`, `parent_cat_id`, `sub_cat_description`, `sub_cat_image`, `sub_cat_slug`) VALUES
(1, 'PHP Tutorials', 1, 'PHP Description...', 'ph-100x100.png', 'php-tutorials'),
(2, 'Java', 1, 'Java Description...', 'ph-100x100.png', ''),
(3, 'Time Management', 2, '', 'Img_sub_cat_09-15-2019_1568578484_blur-bright-close-up-1209998.jpg', 'time-management'),
(4, 'Investment', 3, '', 'Img_sub_cat_09-17-2019_1568744990_investment.jpg', 'investment'),
(5, 'Guidelines', 4, '', 'Img_sub_cat_09-18-2019_1568787789_placeholder-square.jpg', 'guidelines'),
(6, 'Human Stories', 4, '', 'Img_sub_cat_09-22-2019_1569141400_human-stories.jpg', 'human-stories'),
(7, 'Life Chapter', 4, '', 'Img_sub_cat_09-22-2019_1569141530_life-chapter.jpg', 'life-chapter'),
(8, 'Love Truth Again', 4, '', 'Img_sub_cat_09-22-2019_1569141669_love-truth-again.jpg', 'love-truth-again'),
(9, 'Poem Porn', 4, '', 'Img_sub_cat_09-22-2019_1569141905_poem-porn.jpg', 'poem-porn'),
(10, 'General', 4, '', 'Img_sub_cat_09-24-2019_1569318256_general.jpg', 'general'),
(11, 'Difference Between', 1, '', 'Img_sub_cat_09-26-2019_1569491441_difference.jpg', 'difference-between'),
(12, 'Gadgets', 5, '', 'Img_sub_cat_10-03-2019_1570086731_.', 'gadgets');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_firstname` text NOT NULL,
  `user_lastname` text NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_image` text NOT NULL,
  `user_role` varchar(255) NOT NULL,
  `user_description` text NOT NULL,
  `randSalt` varchar(255) NOT NULL DEFAULT '$2y$10$iusesomecrazystrings22',
  `token` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `user_password`, `user_firstname`, `user_lastname`, `user_email`, `user_image`, `user_role`, `user_description`, `randSalt`, `token`) VALUES
(1, 'ashwin', '$1$D9YTTMda$96nY5gB72T/jRZDOWlZid/', 'Ashwin', 'Pandey', 'ashwin@knowledgesheer.com', 'portrait.png', 'admin', 'Hi, I like to be myself... and stay that way...', '$2y$10$iusesomecrazystrings22', ''),
(2, 'ashwin2', '$2y$10$iusesomecrazystrings2uZPDPgQbE4mPf23XG0OdXGRV4xVKX60m', 'Ashwin', 'Pandey', 'ash.pandey011197@gmail.com', 'Img_profile_09-15-2019_1568574409_ph-100x100.png', 'admin', 'Hello there... How are you?', '$2y$10$iusesomecrazystrings22', ''),
(3, 'ashwin3', '$2y$10$iusesomecrazystrings2uZPDPgQbE4mPf23XG0OdXGRV4xVKX60m', 'Ashwin', 'Pandey', 'ashwinpandey011197@gmail.com', 'ph-100x100.png', 'editor', '', '$2y$10$iusesomecrazystrings22', ''),
(4, 'ashwin4', '$2y$10$iusesomecrazystrings2uZPDPgQbE4mPf23XG0OdXGRV4xVKX60m', 'Ashwin', 'Pandey', 'example@gmail.com', '', 'subscriber', '', '$2y$10$iusesomecrazystrings22', ''),
(5, 'Erebus', '$2y$10$iusesomecrazystrings2uGxZwGWv/QTFLUgvB7HxkNCw62xM3V56', 'Chandraprakash', 'Yadav', 'chandraprakashyadav543@gmail.com', 'Img_profile_09-15-2019_1568570887_chandu.png', 'editor', 'Carpe diem', '$2y$10$iusesomecrazystrings22', ''),
(6, 'JayKay', '$2y$10$iusesomecrazystrings2ucKVggzyxAoHteA0/gRCPVAZMywOY7CC', 'Jayesh', 'Kadam', 'jayesh@knowledgesheer.com', 'Img_profile_09-16-2019_1568610786_61727287_2311767362217296_8576475654847987712_o.jpg', 'editor', 'Inspiring by Thoughts, Expressing by Word,I believe to be a Wordsmith. In this big world there is need of big word... \"Word is power  Power is Word\"', '$2y$10$iusesomecrazystrings22', '');

-- --------------------------------------------------------

--
-- Table structure for table `user_roles`
--

CREATE TABLE `user_roles` (
  `role_id` int(11) NOT NULL,
  `role_title` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_roles`
--

INSERT INTO `user_roles` (`role_id`, `role_title`) VALUES
(1, 'admin'),
(2, 'subscriber'),
(3, 'editor');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blog_comments`
--
ALTER TABLE `blog_comments`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `blog_likes`
--
ALTER TABLE `blog_likes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blog_posts`
--
ALTER TABLE `blog_posts`
  ADD PRIMARY KEY (`post_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `quotes`
--
ALTER TABLE `quotes`
  ADD PRIMARY KEY (`quote_id`);

--
-- Indexes for table `quote_categories`
--
ALTER TABLE `quote_categories`
  ADD PRIMARY KEY (`quote_cat_id`);

--
-- Indexes for table `quote_likes`
--
ALTER TABLE `quote_likes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `quote_id` (`quote_id`),
  ADD UNIQUE KEY `user_id` (`user_id`);

--
-- Indexes for table `sub_categories`
--
ALTER TABLE `sub_categories`
  ADD PRIMARY KEY (`sub_cat_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `user_roles`
--
ALTER TABLE `user_roles`
  ADD PRIMARY KEY (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `blog_comments`
--
ALTER TABLE `blog_comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `blog_likes`
--
ALTER TABLE `blog_likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `blog_posts`
--
ALTER TABLE `blog_posts`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `quotes`
--
ALTER TABLE `quotes`
  MODIFY `quote_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `quote_categories`
--
ALTER TABLE `quote_categories`
  MODIFY `quote_cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `quote_likes`
--
ALTER TABLE `quote_likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sub_categories`
--
ALTER TABLE `sub_categories`
  MODIFY `sub_cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user_roles`
--
ALTER TABLE `user_roles`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
