-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 2018-08-03 10:47:56
-- 服务器版本： 5.7.14
-- PHP Version: 7.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mysamplebbs`
--

-- --------------------------------------------------------

--
-- 表的结构 `bbs_user`
--

CREATE TABLE `bbs_user` (
  `userId` int(11) UNSIGNED NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `user_psw` varchar(50) NOT NULL,
  `heardImgUrl` varchar(200) DEFAULT NULL,
  `user_email` varchar(50) DEFAULT NULL,
  `post_count` int(11) DEFAULT NULL,
  `login_status` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `bbs_user`
--

INSERT INTO `bbs_user` (`userId`, `user_name`, `user_psw`, `heardImgUrl`, `user_email`, `post_count`, `login_status`) VALUES
(1, 'lw', '123456', 'http://192.168.3.164/MyBssNew/heardResource/lwheard.jpg', 'lw@qq.com', 0, 1);

-- --------------------------------------------------------

--
-- 表的结构 `postcontent`
--

CREATE TABLE `postcontent` (
  `postContentId` int(11) NOT NULL,
  `postContent` varchar(300) DEFAULT NULL,
  `imagList` varchar(500) DEFAULT NULL,
  `recordList` varchar(500) DEFAULT NULL,
  `videoList` varchar(500) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `postcontent`
--

INSERT INTO `postcontent` (`postContentId`, `postContent`, `imagList`, `recordList`, `videoList`) VALUES
(1, '《三国演义》是中日两国合作制作的动画片，已于2009年在中国上映。该动画片是根据中国古代名著《三国演义》改编，由北京辉煌动画、央视动画与日本未来行星株式会社联手打造的高清动画。 [1-3] \r\n《三国演义》描述了东汉末年，山河动荡，刘汉王朝气数将尽。内有十常侍颠倒黑白，祸乱朝纲；外有张氏兄弟高呼“苍天当死，黄天当立”的口号，掀起浩大的农民起义。一时间狼烟四起，战火熊熊，刘家的朝廷宛如大厦将倾，岌岌可危。', '["http://192.168.3.164/MyBssNew/heardResource/1525265921962586.jpg","http://192.168.3.164/MyBssNew/heardResource/1525265922696520.jpg","http://192.168.3.164/MyBssNew/heardResource/1525266082330879.jpg"]', NULL, NULL),
(2, '《水浒传》是由中央电视台与中国电视剧制作中心联合出品的43集电视连续剧，根据明代施耐庵的同名小说改编。 [1]  由张绍林执导，杨争光 、冉平改编，李雪健、周野芒、臧金生、丁海峰、赵小锐领衔主演。\r\n该剧讲述的是宋朝徽宗时皇帝昏庸、奸臣当道、官府腐败、贪官污吏陷害忠良，弄得民不聊生，许多正直善良的人被官府逼得无路可走，被迫奋起反抗，最终108条好汉聚义梁山泊，但随后宋江对朝廷的投降使得一场轰轰烈烈的农民起义最后走向失败的故事。', '["http://192.168.3.164/MyBssNew/heardResource/1525265922312794.jpg","http://192.168.3.164/MyBssNew/heardResource/lwheard.jpg","http://192.168.3.164/MyBssNew/heardResource/1525266081938525.jpg"]', NULL, NULL),
(3, '《红楼梦》是一部具有世界影响力的人情小说作品 [6]  ，举世公认的中国古典小说巅峰之作，中国封建社会的百科全书，传统文化的集大成者。小说以“大旨谈情，实录其事”自勉，只按自己的事体情理，按迹循踪，摆脱旧套，新鲜别致 [1]  ，取得了非凡的艺术成就。“真事隐去，假语村言”的特殊笔法更是令后世读者脑洞大开，揣测之说久而遂多 [6]  。围绕《红楼梦》的品读研究形成了一门显学——红学。', '["http://192.168.3.164/MyBssNew/heardResource/20180421210616-th_id=OIP.jpg","http://192.168.3.164/MyBssNew/heardResource/20180421210624-th_id=OIP.jpg","http://192.168.3.164/MyBssNew/heardResource/th_id=OIP.jpg"]', NULL, NULL),
(19, '哦泼猴哦肉咯特烦刻苦布局哦泼猴凝固应付欧莱雅大课间咯你酷狗女女诺诺头木女墨头木女的后脑勺我先了数据结构图片了。', '["http://192.168.3.164/MyBssNew/heardResource/1525778062358639.jpg","http://192.168.3.164/MyBssNew/heardResource/c9a52b64ee6fc8e5ef119541965a4b40.jpg","http://192.168.3.164/MyBssNew/heardResource/f97290ca292b3c9bda374763b46ec7dd.jpg"]', ' ', ' ');

-- --------------------------------------------------------

--
-- 表的结构 `postdescribe`
--

CREATE TABLE `postdescribe` (
  `postId` int(11) UNSIGNED NOT NULL,
  `postTitle` varchar(20) NOT NULL,
  `userId` int(11) NOT NULL,
  `moduleId` int(11) NOT NULL,
  `browsCount` int(15) DEFAULT NULL,
  `likeCount` int(15) DEFAULT NULL,
  `releaseTime` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `postdescribe`
--

INSERT INTO `postdescribe` (`postId`, `postTitle`, `userId`, `moduleId`, `browsCount`, `likeCount`, `releaseTime`) VALUES
(1, '三国演义', 1, 1, 12, 0, '2018-03-01 00:00:00'),
(2, '水浒传', 1, 1, 7, 0, '2018-03-13 00:00:00'),
(3, '红楼梦', 1, 2, 9, 0, '2018-04-05 00:00:00'),
(19, '测试帖子', 1, 1, 10, 3, '2018-05-08 07:14:27');

-- --------------------------------------------------------

--
-- 表的结构 `postmodule`
--

CREATE TABLE `postmodule` (
  `moduleId` int(11) NOT NULL,
  `moduleTitle` varchar(50) DEFAULT NULL,
  `moduleDesc` varchar(200) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `postmodule`
--

INSERT INTO `postmodule` (`moduleId`, `moduleTitle`, `moduleDesc`) VALUES
(1, '英雄长存', '666'),
(2, '柔情似水', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bbs_user`
--
ALTER TABLE `bbs_user`
  ADD PRIMARY KEY (`userId`);

--
-- Indexes for table `postcontent`
--
ALTER TABLE `postcontent`
  ADD PRIMARY KEY (`postContentId`);

--
-- Indexes for table `postdescribe`
--
ALTER TABLE `postdescribe`
  ADD PRIMARY KEY (`postId`);

--
-- Indexes for table `postmodule`
--
ALTER TABLE `postmodule`
  ADD PRIMARY KEY (`moduleId`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `bbs_user`
--
ALTER TABLE `bbs_user`
  MODIFY `userId` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- 使用表AUTO_INCREMENT `postdescribe`
--
ALTER TABLE `postdescribe`
  MODIFY `postId` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
