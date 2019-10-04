-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- 主機: 127.0.0.1
-- 產生時間： 2018 年 06 月 24 日 15:02
-- 伺服器版本: 10.1.30-MariaDB
-- PHP 版本： 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `group_08`
--
CREATE DATABASE IF NOT EXISTS `group_08` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `group_08`;

-- --------------------------------------------------------

--
-- 資料表結構 `board`
--

CREATE TABLE `board` (
  `mes_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL COMMENT '留言者ID',
  `movie_id` int(11) NOT NULL COMMENT '電影',
  `content` varchar(1024) COLLATE utf8_unicode_ci NOT NULL COMMENT '內容',
  `mes_date` date NOT NULL COMMENT '留言日期'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 資料表的匯出資料 `board`
--

INSERT INTO `board` (`mes_id`, `user_id`, `movie_id`, `content`, `mes_date`) VALUES
(131, 2, 21, '測試用帳號 到此一遊', '2018-06-18'),
(132, 2, 2, '測試用帳號 到此一遊2', '2018-06-18'),
(133, 2, 0, '測試用帳號 到此一遊3', '2018-06-18'),
(134, 2, 0, '測試用帳號 到此一遊4', '2018-06-18'),
(135, 2, 0, '測試用帳號 到此一遊5', '2018-06-18'),
(136, 2, 0, '測試用帳號 到此一遊2', '2018-06-18'),
(138, 2, 0, '測試用帳號 到此一遊', '2018-06-18'),
(139, 4, 0, '光頭哥哥到此一遊', '2018-06-18'),
(140, 4, 0, '光頭定南到此一遊', '2018-06-18');

-- --------------------------------------------------------

--
-- 資料表結構 `cart`
--

CREATE TABLE `cart` (
  `userAccount` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `movieID` int(11) NOT NULL,
  `state` enum('待付款','已結帳','最近取消的訂單') COLLATE utf8_unicode_ci NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 資料表的匯出資料 `cart`
--

INSERT INTO `cart` (`userAccount`, `movieID`, `state`, `date`) VALUES
('member', 27, '待付款', '2018-06-18');

-- --------------------------------------------------------

--
-- 資料表結構 `movie`
--

CREATE TABLE `movie` (
  `id` int(11) NOT NULL,
  `chi_name` varchar(256) COLLATE utf8_unicode_ci NOT NULL COMMENT '電影中文名稱',
  `eng_name` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '電影英文名稱',
  `cover_path` varchar(2000) COLLATE utf8_unicode_ci NOT NULL COMMENT '封面路徑',
  `releaseDate` date DEFAULT NULL COMMENT '上映日期',
  `trailer_path` varchar(2000) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '預告片路徑',
  `introduce` varchar(2000) COLLATE utf8_unicode_ci NOT NULL COMMENT '電影介紹文字',
  `category` varchar(256) COLLATE utf8_unicode_ci NOT NULL COMMENT '電影分類',
  `Length` time DEFAULT NULL COMMENT '預告片長度',
  `directors` varchar(256) COLLATE utf8_unicode_ci NOT NULL COMMENT '導演',
  `actors` varchar(2000) COLLATE utf8_unicode_ci NOT NULL COMMENT '演員',
  `price` int(11) NOT NULL COMMENT '電影價格',
  `isLaunched` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否發布',
  `isNewProduct` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否是新上映',
  `rate` enum('普遍級','保護級','輔導級','限制級') COLLATE utf8_unicode_ci NOT NULL DEFAULT '普遍級' COMMENT '電影分級(美國)',
  `listOrder` int(11) DEFAULT NULL COMMENT 'List呈現順序'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 資料表的匯出資料 `movie`
--

INSERT INTO `movie` (`id`, `chi_name`, `eng_name`, `cover_path`, `releaseDate`, `trailer_path`, `introduce`, `category`, `Length`, `directors`, `actors`, `price`, `isLaunched`, `isNewProduct`, `rate`, `listOrder`) VALUES
(0, '比得兔', 'PETER RABBIT', 'img/cover/0.jpg', '2018-04-04', 'https://www.youtube.com/embed/cbsFvIOBoTY', '世界著名的童書故事《比得兔》終將「跳」上大銀幕魅力鉅獻！這次除了小兔比得在小麥先生(多姆納爾格利森 飾演)「開心農場」中的偷菜諜對諜將更白熱化外，兩人的關係亦會受到超有愛心的鄰居碧小姐(蘿絲拜恩 飾演)影響，悄悄出現意想不到的神秘變化⋯', '劇情', '00:00:01', '魏德聖(asdad adas)', '約翰波耶加(John Boyega),史考特伊斯威特(Scott Eastwood),景甜(Jing Tian),菊地凜子(Rinko Kikuchi),查理戴(Charlie Day),安卓亞霍娜(Adria Arjona)', 100, 1, 0, '普遍級', 9),
(1, '環太平洋2：起義時刻', 'Pacific Rim: Uprising', 'img/cover/1.jpg', '2018-03-21', 'https://www.youtube.com/embed/k2gcXBnvQSk', '故事設定在2035年，第一集的故事發生的十年後，人類已經完全解除了怪獸的威脅，大戰已經結束，怪獸從太平洋海底竄出的突破點也已經被關閉，但是對於這些兇猛巨獸從異次元再度來襲的恐懼卻仍然存在於人們的心中。全球各地的泛太平洋防衛軍團基地成為捍衛地球的第一防線，並且打造出更先進的機甲獵人，由全新一代的年輕駕駛操作。\r\n然而一個突如其來的事件竟意外打開了環太平洋各地海底的突破點，體積更龐大、更殘暴、更具毀滅性的怪獸再度入侵地球，開始攻擊環太平洋的沿岸城市。\r\n當這些年輕的機甲獵人學員受到捍衛世界的使命感，以及想要為壯烈犧牲的上一代機甲獵人駕駛報仇雪恨的決心驅使，加入對抗怪獸軍團的起義行動，為了捍衛家園誓死奮戰。', '奇幻,科幻,動作,戰爭', '00:00:01', '魏德聖(asdad adas),癢癢(Yunyung)', '約翰波耶加(John Boyega),史考特伊斯威特(Scott Eastwood),景甜(Jing Tian),菊地凜子(Rinko Kikuchi),查理戴(Charlie Day),安卓亞霍娜(Adria Arjona)', 200, 1, 1, '普遍級', 5),
(2, '侏羅紀世界：殞落國度', 'JURASSIC WORLD FALLEN KINGDOM', 'img/cover/2.jpg', '2018-06-06', 'https://www.youtube.com/embed/Sjur_kVGwAM', '充滿著幻想、冒險和驚悚的元素也是當今電影史上最受歡迎和成功的系列電影，這次帶給大家的是所有喜愛的角色與恐龍，再加上前所未見，更令人驚嘆和駭人的全新品種。歡迎蒞臨《侏羅紀世界：殞落國度》。\r\n\r\n克里斯普拉特和布萊絲達拉斯霍華攜手與執行製片史蒂芬史匹柏和柯林崔佛洛一起回歸環球影業和安培林娛樂公司聯合推出的2018年暑期強檔《侏羅紀世界：殞落國度》。本片除了《侏羅紀世界》原班人馬克里斯普拉特、布萊絲達拉斯霍華、黃榮亮、傑夫高布倫之外，還加入新的演員陣容包括詹姆斯克倫威爾、泰德李凡、陶比瓊斯、瑞夫史波…等等。\r\n\r\n《侏羅紀世界：殞落國度》這部史詩動作冒險鉅片由《浩劫奇蹟》胡恩安東尼奧巴亞納執導，編劇是《侏羅紀世界》導演柯林崔佛洛和德瑞克康納利。製片群是由史蒂芬史匹柏和柯林崔佛洛領軍法蘭克馬歇爾和派翠克科羅利聯合製作。製作人貝蓮恩艾緹莎也加入製作的行列。環球影業發行 2018年6月 震撼登場', '奇幻,科幻,冒險,動作', '00:00:02', '魏德聖(asdad adas),癢癢(Yunyung)', '約翰波耶加(John Boyega),史考特伊斯威特(Scott Eastwood),景甜(Jing Tian),菊地凜子(Rinko Kikuchi),查理戴(Charlie Day),安卓亞霍娜(Adria Arjona)', 300, 1, 1, '普遍級', 21),
(3, '星際大戰外傳 : 韓索羅', 'SOLO A STAR WARS STORY', 'img/cover/3.jpg', '2018-05-23', 'https://www.youtube.com/embed/BzdhGCQXXb4', '韓索羅是《星際大戰》系列中的經典人物，有著精湛的飛行技術和叛逆獨行的作風，《星際大戰外傳：韓索羅》將揭露他過去的冒險事跡，故事設定在他與莉亞公主和路克相遇前，因緣際會下成為千年鷹號的主人，與丘巴卡相遇，並聯手成為星際間惡名昭彰的走私客。', '奇幻,科幻,冒險,動作,劇情', '00:00:02', '魏德聖(asdad adas),癢癢(Yunyung)', '約翰波耶加(John Boyega),史考特伊斯威特(Scott Eastwood),景甜(Jing Tian),菊地凜子(Rinko Kikuchi),查理戴(Charlie Day),安卓亞霍娜(Adria Arjona)', 87, 1, 1, '普遍級', 10),
(4, '死侍2', 'DEADPOOL 2', 'img/cover/4.jpg', '2018-05-15', 'https://www.youtube.com/embed/sHEVplQdg5A', '《死侍2》不只包括從「死侍」本人萊恩雷諾斯再次親手擔綱本片監製與男主角的重要角色，更是首度好萊塢動作片名導《捍衛任務》大衛雷奇合作。而首集中出現的重要角色們，包括「青少女彈頭」布莉安娜海德布蘭德〈Brianna Gildebrand〉、「鋼人」〈Stefan Kapicic〉、「盲婦愛兒」萊絲莉厄格絲〈Leslie Uggams〉、「死侍女友」莫蓮娜芭卡琳〈Morena Baccarin〉，甚至連死侍的好麻吉，印度計程車司機「阿杜」卡蘭索尼〈Karan Soni〉也都全數力挺，再次回歸這個影史最賤英雄的最新續作。除此之外，本次更是找來了新血加入，包括由薩琪彼茲〈Zazie Beetz〉所飾演的「多米諾」，以及「機堡」喬許布洛林〈Josh Brolin〉。', '動作', '00:00:02', '魏德聖(asdad adas),癢癢(Yunyung)', '約翰波耶加(John Boyega),史考特伊斯威特(Scott Eastwood),景甜(Jing Tian),菊地凜子(Rinko Kikuchi),查理戴(Charlie Day),安卓亞霍娜(Adria Arjona)', 52, 1, 0, '普遍級', 16),
(5, '復仇者聯盟 : 無限之戰', 'AVENGERS INFINITY WAR', 'img/cover/5.jpg', '2018-04-25', 'https://www.youtube.com/embed/bjM1WcXVpt0', '★好萊塢No. 1極致體驗, 首創全片以IMAX數位鏡頭拍攝。<br>★集漫威電影宇宙10年之大成的宏偉鉅作。<br><br>一部集漫威電影宇宙10年之大成的宏偉鉅作，《復仇者聯盟3：無限之戰》將帶來前所未見，最極致、最致命的存亡對決。復仇者聯盟和他們的超級英雄盟友們必須要不顧一切攜手合作才有可能組止最強的終極反派薩諾斯將整個宇宙毀滅。\r\n', '冒險,動作', '00:00:02', '魏德聖(asdad adas),癢癢(Yunyung)', '約翰波耶加(John Boyega),史考特伊斯威特(Scott Eastwood),景甜(Jing Tian),菊地凜子(Rinko Kikuchi),查理戴(Charlie Day),安卓亞霍娜(Adria Arjona)', 173, 1, 0, '保護級', 17),
(6, '原罪犯', 'OLDBOY', 'img/cover/6.jpg', '2018-05-11', 'https://www.youtube.com/embed/pXbK4ybGMA4', '朴贊郁導演作品《我要復仇》《原罪犯》《親切的金子》並稱「復仇三部曲」。大秀（崔岷植 飾）是個平凡無奇的生意人，某天卻突然被人綁走，對於被綁架的這段時間毫無記憶，醒來時他發現自己身在一間密室當中，房間中只有一台電視。不知道如何離開的大秀每日無所事事，某天在房間看電視時竟得知妻子慘遭殺害，而犯罪嫌疑人居然正是自己，頓時感到憤怒不已，內心震驚、哀傷複雜情緒交錯，大秀告訴自己不能坐以待斃，並開始用湯匙在地上慢慢挖掘地道，希望總有一天能逃出密室，尋找事件真相。<br><br>過了漫長的十五年，大秀終於逃出了密室，重新回到社會中。他將自己不幸的經歷告訴巧遇的一位女子美度（姜惠貞 飾），於是美度決定要和大秀一同追查這起離奇事件。大秀卻在這時候接到一通電話，電話的另一頭告訴他，必須在五天內查出自己被囚禁的原因，否則就殺死美度……', '犯罪,懸疑,驚悚,劇情', '00:00:02', '魏德聖(asdad adas),癢癢(Yunyung)', '約翰波耶加(John Boyega),史考特伊斯威特(Scott Eastwood),景甜(Jing Tian),菊地凜子(Rinko Kikuchi),查理戴(Charlie Day),安卓亞霍娜(Adria Arjona)', 50, 1, 0, '輔導級', 18),
(7, '真心話大冒險', 'TRUTH OR DARE', 'img/cover/7.jpg', '2018-05-11', 'https://www.youtube.com/embed/RUmDIJ14is8', 'Blumhouse 製作公司繼《忌日快樂》、《逃出絕命鎮》、《分裂》之後推出超自然驚悚片《真心話大冒險》，由露西海爾（《美少女的謊言》）與泰勒波西（電視影集《少年狼》）領銜主演。一群好朋友玩的無害遊戲「真心話大冒險」變調為死亡序曲，說謊或拒絕大冒險的人開始遭受恐怖力量的懲罰。<br><br>本片導演為傑夫瓦德洛（《特攻聯盟2》），其他演員包含維奧莉畢恩、海登司徒、藍頓萊柏隆、索菲亞泰勒阿里、諾蘭傑拉德馮克。製片為Blumhouse 製作公司的傑森布倫，監製為傑夫瓦德洛、克里斯羅奇、珍妮特沃爾圖諾和庫柏山謬森。', '懸疑,驚悚', '00:00:01', '魏德聖(asdad adas),癢癢(Yunyung)', '約翰波耶加(John Boyega),史考特伊斯威特(Scott Eastwood),景甜(Jing Tian),菊地凜子(Rinko Kikuchi),查理戴(Charlie Day),安卓亞霍娜(Adria Arjona)', 700, 1, 0, '限制級', 19),
(8, '刺殺終點戰', 'TERMINAL', 'img/cover/8.jpg', '2018-05-04', 'https://www.youtube.com/embed/vmR7AOy33Vk', '瘋狂，是他們的復仇之道<br>在這個神祕又黑暗的城市裡，犯罪，只是家常便飯。被絕症折磨的教師比爾（賽門佩吉飾演）試圖自我了斷，但始終想死卻死不成。某日，比爾在深夜的咖啡廳裡結識了美豔金髮女服務生安妮（瑪格羅比飾演）。兩人竟因為「如何成功自殺」這話題而打開話匣子，培養出一段詭異友誼…。而在城市的另一角落，兩位正在執行危險任務的殺手（麥斯艾朗、戴克斯特佛萊契飾演），為了獲得高額賞金在城市之間來回奔走，急切想要找到暗殺目標的線索…。<br><br>然而夜班警衛（麥克邁爾斯飾演）的出現，竟意外牽起這兩組貌似毫無關聯的人物。隨著一樁又一樁的犯罪事件發生，也逐漸揭露出眾人的神秘過去，以及交織而成的愛恨情仇。最終，他們發現自己全被捲入一場錯綜複雜的犯罪大計。究竟他們能否找出事實真相？而事件背後的神秘主謀又是誰呢？\r\n', '犯罪,懸疑,驚悚,劇情', '00:00:01', '魏德聖(asdad adas),癢癢(Yunyung)', '約翰波耶加(John Boyega),史考特伊斯威特(Scott Eastwood),景甜(Jing Tian),菊地凜子(Rinko Kikuchi),查理戴(Charlie Day),安卓亞霍娜(Adria Arjona)', 150, 1, 0, '普遍級', 22),
(9, '換季男友', 'IN BETWEEN SEASONS', 'img/cover/9.jpg', '2018-05-18', 'https://www.youtube.com/embed/4DlewYQ_eno', '★第21屆釜山影展 觀眾票選獎\r\n★改編自ALADIN年度最佳漫畫 圖文小說首獎\r\n★實力派演員裴宗玉 ╳ 新星演員李源根、池允浩 閃亮組合！\r\n★三個人之間，兩個人的秘密\r\n\r\n一場車禍，一位母親與兩位大男孩的世界就此改變...\r\n\r\n美京媽媽最近臉上總掛著微笑，因為青春期有點距離的兒子秀賢變開朗了，一切都歸功於兒子的好友勇俊出現。由於家中出了變故，勇俊需要借住秀賢家，彬彬有禮的勇俊讓原本稍嫌寂寞的大房子，似乎也變得溫暖、熱鬧許多，一想到自己好像多了一個兒子陪伴，美京就止不住笑意。 \r\n\r\n沒想到一場車禍意外，秀賢傷重陷入了昏迷，同車的勇俊卻只有皮肉傷。一邊煩惱兒子病情、一邊要處理失和丈夫的關係，已經一片混亂的美京突然發現天大的秘密：原來勇俊不只是秀賢的好朋友，而是男朋友。而無家可歸也必須趕來醫院探望心愛男友的勇俊卻不知道，兩人純潔透明的愛情將會為自己帶來無盡的折磨... \r\n\r\n根據導演李東恩的得獎暢銷漫畫改編，真摯坦白，細膩純真，觸動人心最柔軟的角落。結局美好中帶著遺憾，久久讓人難忘。', '愛情,劇情', '00:00:01', '魏德聖(asdad adas),癢癢(Yunyung)', '約翰波耶加(John Boyega),史考特伊斯威特(Scott Eastwood),景甜(Jing Tian),菊地凜子(Rinko Kikuchi),查理戴(Charlie Day),安卓亞霍娜(Adria Arjona)', 170, 1, 0, '普遍級', 20),
(10, '圍雞總動員', 'BLOCKERS', 'img/cover/10.jpg', '2018-04-20', 'https://www.youtube.com/embed/4WJ76fdKq0E', '當三名家長無意間發現他們的女兒立下一個誓約，打算在畢業舞會之夜破處，他們就展開一場機密行動，試圖阻止他們的女兒完成她們的破處合約。《圍雞總動員》一片由萊斯莉曼恩（《婦仇者聯盟》、《40惑不惑》）、伊凱巴林霍茲（《惡鄰纏身》、《自殺突擊隊》）以及約翰希南（《姐姐愛最大》、《瞎趴姊妹》）領銜主演，《歌喉讚》系列電影編劇凱卡農首度擔任導演。\r\n\r\n這部喜劇片的製片包括Point Grey電影公司（《惡鄰纏身》、《大明星世界末日》）的塞斯羅根、伊凡戈博以及詹姆斯魏佛、強赫維茲及海登施拉茲伯格（《豬頭漢堡包》系列電影），以及DMG娛樂公司的克里斯芬頓（《浪人47》）。 \r\n\r\n執行製片包括好宇宙製作公司的納森卡海恩和喬卓瑞克（《暫時停止呼吸》、《鴻孕當頭》）、DMG娛樂公司的克里斯考爾斯（《偷天劫車手》）以及喬許費根、大衛史塔森和強納森麥考伊。這部電影的編劇包括布萊恩基荷和吉姆基荷兄弟、強赫維茲和海登施拉茲伯格以及艾本羅素。', '喜劇', '00:00:01', '魏德聖(asdad adas),癢癢(Yunyung)', '約翰波耶加(John Boyega),史考特伊斯威特(Scott Eastwood),景甜(Jing Tian),菊地凜子(Rinko Kikuchi),查理戴(Charlie Day),安卓亞霍娜(Adria Arjona)', 96, 1, 0, '普遍級', 24),
(14, '癢癢電影gogo', 'YUNGYUNGGHOGO', 'img/cover/14.jpg', '2018-06-08', 'https://www.youtube.com/embed/k2gcXBnvQSk', 'ASDADASD', '奇幻,冒險', '00:02:03', 'ADASDAS,ASDASD', '眼1,眼2', 78, 1, 1, '保護級', 23),
(15, '蟻人與黃蜂女', 'ANT MAN AND THE WASP', 'img/cover/15_1529243662.jpg', '2018-07-04', 'https://www.youtube.com/embed/xFkFkU4yPsk', '故事接續在《美國隊長3：英雄內戰》之後，史考特朗恩因為參與了內戰判刑，帶上電子腳鐐，居家監禁，在父親和蟻人兩個角色中左支右絀。眼看刑期終於快服滿，皮姆博士和荷普又帶著危急的任務找上門，史考特不得不再次穿上蟻人裝束，與黃蜂女一起對抗來自過去的黑暗秘密。', '奇幻,動作,科幻', '00:01:58', '派頓瑞德(Peyton Reed)', '保羅路德(Paul Rudd),伊凡潔琳莉莉(Evangeline Lilly), 麥克道格拉斯(Michael Douglas),麥可潘納(Michael Peña),蜜雪兒菲佛(Michelle Pfeiffer),勞倫斯費雪朋(Laurence Fishburne)', 125, 1, 1, '輔導級', 3),
(16, '冠軍大叔', 'CHAMPION', 'img/cover/16_1529244131.jpg', '2018-06-15', 'https://www.youtube.com/embed/ZZunrxJ7ZXc', '在美國洛杉磯夜店工作的馬克（馬東石飾），一直夢想在腕力比賽中成為世界冠軍，被自認是他經紀人的晉基（權律飾）說服，回到韓國參加全國腕力大賽。\r\n\r\n除了比賽之外，晉基還送了從小被領養到美國的馬克親生母親住家地址當做回國禮物。不過，馬克只遇見從沒見過面的妹妹秀珍（韓藝利飾）和她的一雙兒女。在晉基牽線下，馬克參加非法的腕力比賽。面對腕力怪物強敵環伺，在家人的支持下，馬克能夠一圓冠軍夢嗎？', '劇情,其他', '00:02:12', '金榮完(Kim Yong-Wan)', '馬東石(Ma Dong-Seok),韓藝利(Han Ye-Ri),權律(Kwon Yul)', 112, 1, 1, '輔導級', 4),
(17, '只有大海知道', 'LONG TIME NO SEA', 'img/cover/17_1529244658.jpg', '2018-06-15', 'https://www.youtube.com/embed/k2sTU7Y8Oyo', '自小由年邁祖母養育長大的男孩馬那衛，總盼望長期在台灣謀生的缺席父親，有天能回到蘭嶼、陪伴他的成長。這個夏天，學校來了一位年輕老師游仲勛。被迫放棄熱鬧都市生活的他，一心想爭取記功嘉獎，期待早日能調回台灣。\r\n\r\n有天，傳來一個好消息！全國原住民舞蹈大賽將於高雄舉辦，蘭嶼決定參加。仲勛立刻自告奮勇，接下指導老師的重責大任。馬那衛則想趁此機會，飛到台灣、給父親一個驚喜。大家都為了夢想奮力一戰，但在集訓過程中，仲勛卻發現，孩子們對代表達悟文化的丁字褲顯然排斥，不願穿著它上台表演。\r\n\r\n眼看比賽即將到來，仲勛如何能讓孩子們、從文化中找回驕傲與勇氣，願意穿上丁字褲登台演出？而當他們踏上台灣，仲勛和馬那衛原先的夢想，也開始有了轉變。', '其他', '00:01:37', '崔永徽(Heather Tsui)', '黃尚禾(Shang-Ho Huang),鍾家駿(Chia-Chun Chung),李鳳英(Feng-Ying Lee),張靈(Ling Chang)', 200, 1, 1, '普遍級', 11),
(18, '電影版 巧虎的彩虹綠洲', 'SHIMAJIRO AND THE RAINBOW OASIS', 'img/cover/18_1529245093.jpg', '2018-02-02', 'https://www.youtube.com/embed/jc-Fuk7BhdA', '一部關於父母與孩子之間親情的冒險故事\r\n巧虎、琪琪、妙妙和桃樂比，開心的來到卡歐先生的家，參觀他的最新發明—鑽地號，一個不小心啟動了開關，於是巧虎一行人被鑽地號帶進了地底，好不容易鑽出地面後，他們竟然來到了遙遠的沙漠！而鑽地號也壞了……\r\n\r\n住在沙漠裡的可可跟她的媽媽被可怕的沙塵暴拆散了，巧虎他們決定幫助可可一起尋找她的媽媽，途中遇到了愛玩遊戲的蛇小妹，以及愛唱饒舌歌曲的刺刺哥等好朋友，還來到了沙漠裡的彩虹綠洲。\r\n\r\n巧虎他們要如何克服困難，幫助可可找到媽媽呢？最後，巧虎和好朋友們能夠平安的回到巧虎島嗎？', '奇幻,冒險', '00:01:00', '平林勇', '許淑嬪,楊凱凱,劉錫華,馮嘉德', 1, 1, 0, '普遍級', 25),
(19, '我的家人歐買尬', 'LORD GIVE ME PATIENCE', 'img/cover/19_1529245465.jpg', '2018-06-15', 'https://www.youtube.com/embed/S8Sm3YUgyCg', '格里歐（佐迪桑切斯飾）是一位脾氣暴躁又保守的銀行家，也是西班牙皇家馬德里隊的死忠足球迷。在妻子（蘿西德帕瑪飾）意外去世後，他必須履行亡妻遺願：與子女一同前往她的故鄉聖路卡，將骨灰撒向大海。\r\n\r\n這場旅途中，同行的大女婿是獨立派加泰隆尼亞人兼巴塞隆納隊粉絲、二女兒的男友是激進共產主義嬉皮，還有兩年沒跟他說過話的同性戀小兒子，私自跟塞內加爾裔黑人訂婚。存在於兩代間的同性戀與種族歧視、皇馬對巴塞隆納球隊的較勁、西班牙統獨派的對立，他們能否跨越觀念上的鴻溝，學會包容彼此？\r\n\r\n導演阿瓦洛迪亞茲羅倫佐（Alvaro Diaz Lorenzo）從美國喜劇《小太陽的願望》汲取靈感，刻劃眾多角色的鮮明個性，集結大咖演員佐迪桑切斯（Jordi Sanchez）、蘿西德帕瑪（Rossy de Palma）共同飆戲，以「公路電影」的形式展開一場多元文化旅程。\r\n\r\n劇情反映西班牙當前如移民、同性婚姻、政治立場等社會衝突，上映首周票房即飆破千萬台幣，獲得百萬觀眾共鳴。這是一部與情感息息相關的溫馨家庭喜劇，當冒險旅途走到尾聲，愛與寬容將克服所有成見。', '喜劇', '00:01:31', '阿瓦洛迪亞茲羅倫佐(Álvaro Díaz Lorenzo)', '佐迪桑切斯(Jordi Sánchez) ,蘿西德帕瑪(Rossy de Palma)', 77, 1, 1, '保護級', 14),
(20, '瞞天過海 : 八面玲瓏', 'OCEANS EIGHT', 'img/cover/20_1529245761.jpg', '2018-06-14', 'https://www.youtube.com/embed/wG90vAK8OOE', '故事由丹尼歐遜的妹妹：黛比歐遜(珊卓布拉克 飾)開始說起，她和哥哥丹尼一樣擅長偷天換日的計畫，功力甚至有過之而無不及。\r\n\r\n黛比獲得假釋的聽證會一幕開始，正好呼應了《瞞天過海》系列第一集丹尼的假釋聽證會開場。黛比坦承自己犯了錯，保證出獄之後將過簡單的生活。但事實上，她早已計劃好了下一?，這次她把目標指向紐約大都會藝術博物館每年舉辦的慈善晚宴。不只將在眾星雲集與鎂光燈閃爍的現場帶走當天的募款，她甚至將目標指向一條價值一億五千萬美金的項鍊，而她只打算用7個人就完成這件驚人之舉。\r\n\r\n黛比一出獄便立刻召集了各路行家，以她為首，凱特布蘭琪與她搭擋，一同進行這一場天衣無縫的計劃。本片眾星雲集，包括安海瑟薇、敏迪卡靈、莎拉保羅森、奧卡菲娜、蕾哈娜與海倫娜波漢卡特一起同台尬戲。', '劇情,冒險,動作', '00:01:51', '蓋瑞羅斯(Gary Ross)', '珊卓布拉克(Sandra Bullock),凱特布蘭琪(Cate Blanchett),安海瑟威(Anne Hathaway),莎拉保羅森(Sarah Paulson),蕾哈娜(Rihanna),海倫娜波漢卡特(Helena Bonham Carter),達珂塔芬妮(Dakota Fanning),麥特戴蒙(Matt Damon),奧莉薇亞孟恩(Olivia Munn),凱蒂荷姆斯(Katie Holmes),李察阿米塔吉(Richard Armitage)', 220, 1, 1, '輔導級', 13),
(21, '電影版 機器戰士 TOBOT 機器人軍團的襲擊', 'TOBOT THE ATTACK AND OF THE ROBOT ARMY', 'img/cover/21_1529246004.jpg', '2018-05-04', 'https://www.youtube.com/embed/VGCkMqEocWQ', '邪惡博士來襲，竟然將所有人都變成了機器人大軍。爸爸陷入危險遭到控制，主角們與機器戰士們合作，努力擊退機器人大軍！\r\n\r\n博士帶著雙胞胎兄弟雷恩與柯利一家人到濟州島旅行，一家人過著愉快的旅行時光，一直到博士接到了工作的緊急電話為止。他告訴兄弟倆必須回到公司參與一場會議，會盡快回到他們身邊。雷恩與柯利懷著失望的心情等待著父親回來，同時也在濟州島上結交了新朋友。\r\n\r\n同時間，平靜的島嶼遭受來自海底巨惡機器人軍團的襲擊。萊恩與柯利，率領戰友機器戰士Tobot們挺身抵抗，並保衛無辜的市民們免於神秘攻擊者的威脅。在戰鬥的過程中，雷恩與柯利發現父親竟然在替邪惡機器人工作？究竟雷恩與柯利是否能擊退神秘的機器人軍團，並救回父親呢？結果只有五月到各上映影城大螢幕見！', '冒險,其他', '00:01:22', '未提供', '未提供', 80, 1, 1, '普遍級', 7),
(22, '蠟筆小新電影：功夫小子之拉麵大亂鬥', 'Crayon Shinchan the Movie: Bakumori! Kung Fu Boys -Ramen Panic', 'img/cover/22_1529246643.jpg', '2018-08-10', 'https://www.youtube.com/embed/Dwp_A5aXBZU', '故事發生在春日部的中華街上的《哎呀城》，「正男」邀請「小新」與「春日部防衛隊」，學習傳說中的功夫－軟Q軟Q拳。並和功夫少女「小蘭」一起努力練功。\r\n\r\n這時候，神秘麵食”黑熊貓拉麵”大流行。那是只要吃過一次就會上癮，且讓人變得兇暴的恐怖拉麵！\r\n\r\n面對這突如襲來的拉麵危機！為了拯救哎呀城，春日部防衛隊挺身而出，他們能夠恢復街上的和平嗎？', '動畫,冒險,喜劇', '00:01:42', '高橋涉', '蠟筆小新', 229, 1, 1, '普遍級', 6),
(23, '媽媽咪呀！回來了', 'Mamma Mia! Here We Go Again', 'img/cover/23_1529246950.jpg', '2018-08-01', 'https://www.youtube.com/embed/BW1nvXLD72c', '準備再度高聲歡唱、翩翩起舞、開懷大笑以及轟轟烈烈愛一場。\r\n\r\n《媽媽咪呀！》在全球締造六億美元的驚人票房成績的十年後，全球觀眾影迷將再度回到充滿神奇魔力的希臘卡洛凱利小島，欣賞一部根據超級天團ABBA阿巴合唱團膾炙人口的動聽歌曲，全新打造的原創歌舞片。除了該片的全體演員再度回歸以外，新生代票房女星莉莉詹姆斯（《仙履奇緣》、《玩命再劫》）率領的全新卡司也加入演出，這部音樂喜劇片將於2018年暑假強檔隆重獻映。', '喜劇,其他', '00:02:02', '歐帕克(Ol Parker)', '梅莉史翠普(Meryl Streep),皮爾斯布洛斯南(Pierce Brosnan),柯林佛斯(Colin Firth),史戴倫史柯斯嘉(Stellan Skarsgard),茱莉華特斯(Julie Walters) ,多明尼克庫柏(Dominic Cooper) ,阿曼達塞佛瑞(Amanda Seyfried),莉莉詹姆斯(Lily James),安迪賈西亞(Andy Garcia),雪兒(Cher),傑瑞米爾文(Jeremy Irvine)', 280, 1, 1, '普遍級', 15),
(24, '不可能的任務：全面瓦解', 'Mission: Impossible Fall Out', 'img/cover/24_1529247359.jpg', '2018-07-25', 'https://www.youtube.com/embed/Z_BorEOhauc\"', '《不可能的任務：全面瓦解》敘述伊森韓特與他的IMF隊員們（亞歷鮑德溫、賽門佩吉和文雷姆斯飾演）以及熟悉的盟友（蕾貝卡弗格森與蜜雪兒摩娜漢所飾演），在一項任務執行失敗後，與時間賽跑試圖力挽狂瀾！這一集更加入重量級卡司：亨利卡維爾、安琪拉貝瑟與凡妮莎柯比，導演是由執導《不可能的任務：失控國度》克里斯多夫麥奎瑞再度擔綱。', '劇情,動作', '00:02:06', '克里斯多夫麥奎利(Christopher McQuarrie)', '湯姆克魯斯(Tom Cruise),賽門佩吉(Simon Pegg),蕾貝卡弗格森(Rebecca Ferguson),文雷姆斯(Ving Rhames),西恩哈里斯(Sean Harris),亞歷鮑德溫(Alec Baldwin),蜜雪兒莫娜漢 (Michelle Monaghan),亨利卡維爾(Henry Cavill)', 202, 1, 1, '普遍級', 8),
(25, '尖叫旅社3：怪獸假期', 'Hotel Transylvania 3: Summer Vacation', 'img/cover/25_1529247593.jpg', '2018-07-19', 'https://www.youtube.com/embed/zk1UaRlHwhg', '最受歡迎的怪獸成員全數到齊，而為了感謝德古拉每天認真工作的辛勞，大夥更驚喜計畫一趟最豪華的瘋狂郵輪假期，決心要讓德古拉好好”鬆”一下充電！然而正當所有人都陶醉在郵輪上的奢華體驗如怪獸排球、”夜”光浴和各式異國特色設施時，梅菲絲卻發現德古拉竟已掉入船長艾麗卡的神秘陷阱裡，且背後暗藏的危險秘密更可能會危害整個怪獸家族，讓原本快樂的出帆竟變成一場最可怕的噩夢⋯', '喜劇,其他', '00:01:37', '格恩迪塔塔科夫斯基', '亞當山德勒(Adam Sandler),席琳娜戈梅茲', 187, 1, 0, '普遍級', 12),
(26, '名偵探柯南：零的執行人', 'Detective Conan: Zero the Enforcer', 'img/cover/26_1529247882.jpg', '2018-07-06', 'https://www.youtube.com/embed/wxG1htsrgFo', '東京灣最新而宏偉的建築「Edge of Ocean」即將在5月1日舉辦國際高峰會，國內外政商聚集，兩萬兩千名警力高度戒備，不料卻遭人暗中潛伏，策動了一場巨大爆炸事故！事件後找到的犯案證物卻遺留毛利小五郎的指紋！毛利小五郎隨即被警方逮捕，而柯南感受到此事件有一層難以揭開的面紗，開始調查。\r\n\r\n此時所屬警察廳秘密組織「零（Zero）」的「安室透」卻阻止柯南參與調查，要證明小五郎清白的機會正漸漸消逝……神秘的安室透被下令執行「極密行動」，背後的主使者到底是誰，是警察廳或許是黑暗組織?腹背受敵的柯南，必須獨自對抗警察和安室透，他會如何脫困？潛伏在角落伺機而動的黑暗組織又有何目的？一切只待引爆那一刻！', '懸疑,驚悚', '00:01:47', '立川讓', '高山南,山口勝平,山崎和佳奈 ,小山力也,古谷徹,林原惠,緒方賢一,岩居由希子', 300, 1, 1, '普遍級', 0),
(27, '超人特攻隊 2', 'THE INCREDIBLES 2', 'img/cover/27_1529248077.jpg', '2018-06-29', 'https://www.youtube.com/embed/pl6iXdS-sCQ', '最受觀眾喜歡的超人家族回來了! 睽違13年，皮克斯終於重啟本系列。《超人特攻隊2》故事設定在第一集結束後，民眾們對超級英雄的想法改觀，一連串的事件讓本來在家當家庭主婦的超能太太反而成為超級英雄代言人，四處奔走。超能先生則是在家當超級奶爸，雖然心有不甘，卻意外發現小兒子小杰超驚人的超能力，這次他們又會碰到甚麼挑戰呢? \r\n\r\n《超人特攻隊》導演與角色將全數回歸，再次為觀眾帶來充滿冒險又笑料十足的《超人特攻隊2》。', '冒險,喜劇', '00:01:58', '布萊德柏德(Brad Bird)', '未提供', 220, 1, 1, '普遍級', 2),
(28, '電影哆啦A夢:大雄的金銀島', 'Doraemon the Movie 2018 Nobita\'s Treasure Island', 'img/cover/28_1529248611.jpg', '2018-06-29', 'https://www.youtube.com/embed/-DFdKn8kcQk', '出發尋寶 \r\n「我一定會找到金銀島！」大雄這麼對胖虎宣言後，就向哆啦A夢求救，使用道具「尋寶地圖」尋找金銀島。而地圖指示出來的位置，居然是太平洋上莫名冒出來的新島嶼……。\r\n\r\n海盜來襲 \r\n大雄一行人搭著名為「大雄奧拉號」的船前往金銀島，就在即將靠岸時，卻有海盜來襲！面對突然現身的敵人，大雄他們陷入一陣苦戰，此時靜香卻被抓到海盜船上了！\r\n\r\n「找到的是，超越寶物的寶物」 \r\n海盜們逃走後，大雄他們遇到了一名在海上漂流的少年「弗洛克」與機器鸚鵡「謎題」。弗洛克是從海盜船逃出來的機械工，而且知道金銀島隱藏的重要秘密！究竟大雄他們是否能夠從海盜手中救出靜香！？而沉眠於金銀島上的財寶究竟又有什麼秘密！？', '劇情,冒險,科幻', '00:01:36', '今井一曉', '長澤雅美(Masami Nagasawa),大泉洋(Yo Oizumi),132', 230, 1, 1, '普遍級', 1);

-- --------------------------------------------------------

--
-- 資料表結構 `movieslider`
--

CREATE TABLE `movieslider` (
  `slider_id` int(11) NOT NULL,
  `slider_path` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `slider_link` varchar(200) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 資料表的匯出資料 `movieslider`
--

INSERT INTO `movieslider` (`slider_id`, `slider_path`, `slider_link`) VALUES
(1, 'img/slider/1.jpg', 'movieDetail.php?id=22'),
(2, 'img/slider/2.jpg', 'movieDetail.php?id=25'),
(3, 'img/slider/3.jpg', 'movieDetail.php?id=22');

-- --------------------------------------------------------

--
-- 資料表結構 `moviestills`
--

CREATE TABLE `moviestills` (
  `id` int(11) NOT NULL,
  `still_path` varchar(200) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 資料表的匯出資料 `moviestills`
--

INSERT INTO `moviestills` (`id`, `still_path`) VALUES
(0, 'img/still/0_00.jpg'),
(0, 'img/still/0_01.jpg'),
(0, 'img/still/0_02.jpg'),
(0, 'img/still/0_03.jpg'),
(0, 'img/still/0_04.jpg'),
(1, 'img/still/1_01.jpg'),
(1, 'img/still/1_02.jpg'),
(1, 'img/still/1_03.jpg'),
(1, 'img/still/1_04.jpg'),
(1, 'img/still/1_05.jpg'),
(2, 'img/still/2_00.jpg'),
(2, 'img/still/2_01.jpg'),
(2, 'img/still/2_02.jpg'),
(2, 'img/still/2_03.jpg'),
(2, 'img/still/2_04.jpg'),
(3, 'img/still/3_01.jpg'),
(3, 'img/still/3_02.jpg'),
(3, 'img/still/3_03.jpg'),
(3, 'img/still/3_04.jpg'),
(3, 'img/still/3_05.jpg'),
(4, 'img/still/4_01.jpg'),
(4, 'img/still/4_02.jpg'),
(4, 'img/still/4_03.jpg'),
(4, 'img/still/4_04.jpg'),
(4, 'img/still/4_05.jpg'),
(5, 'img/still/5_01.png'),
(5, 'img/still/5_02.png'),
(5, 'img/still/5_03.jpg'),
(5, 'img/still/5_04.jpg'),
(5, 'img/still/5_05.jpg'),
(5, 'img/still/5_06.jpg'),
(5, 'img/still/5_07.jpg'),
(6, 'img/still/6_01.jpg'),
(6, 'img/still/6_02.jpg'),
(6, 'img/still/6_03.jpg'),
(6, 'img/still/6_04.jpg'),
(6, 'img/still/6_05.jpg'),
(7, 'img/still/7_01.jpg'),
(7, 'img/still/7_02.jpg'),
(7, 'img/still/7_03.jpg'),
(7, 'img/still/7_04.jpg'),
(7, 'img/still/7_05.jpg'),
(8, 'img/still/8_01.jpg'),
(8, 'img/still/8_02.jpg'),
(8, 'img/still/8_03.jpg'),
(8, 'img/still/8_04.jpg'),
(8, 'img/still/8_05.jpg'),
(9, 'img/still/9_01.jpg'),
(9, 'img/still/9_02.jpg'),
(9, 'img/still/9_03.jpg'),
(9, 'img/still/9_04.jpg'),
(9, 'img/still/9_05.jpg'),
(10, 'img/still/10_01.jpg'),
(10, 'img/still/10_02.jpg'),
(10, 'img/still/10_03.jpg'),
(10, 'img/still/10_04.jpg'),
(10, 'img/still/10_05.jpg'),
(14, 'img/still/14_1529158104.jpg'),
(14, 'img/still/14_1529158105.jpg'),
(14, 'img/still/14_1529158106.JPG'),
(14, 'img/still/14_1529158107.jpg'),
(14, 'img/still/14_1529158108.jpg'),
(14, 'img/still/14_1529158109.jpg'),
(14, 'img/still/14_1529158110.jpg'),
(14, 'img/still/14_1529158111.jpg'),
(14, 'img/still/14_1529158112.jpg'),
(14, 'img/still/14_1529158113.jpg'),
(14, 'img/still/14_1529158114.jpg'),
(14, 'img/still/14_1529158115.png'),
(15, 'img/still/15_01.jpg'),
(15, 'img/still/15_02.jpg'),
(15, 'img/still/15_03.jpg'),
(15, 'img/still/15_04.jpg'),
(15, 'img/still/15_05.jpg'),
(16, 'img/still/16_01.jpg'),
(16, 'img/still/16_02.jpg'),
(16, 'img/still/16_03.jpg'),
(16, 'img/still/16_04.jpg'),
(16, 'img/still/16_05.jpg'),
(17, 'img/still/17_01.jpg'),
(17, 'img/still/17_02.jpg'),
(17, 'img/still/17_03.jpg'),
(17, 'img/still/17_04.jpg'),
(17, 'img/still/17_05.jpg'),
(18, 'img/still/18_01.jpg'),
(18, 'img/still/18_02.jpg'),
(18, 'img/still/18_03.jpg'),
(18, 'img/still/18_04.jpg'),
(18, 'img/still/18_05.jpg'),
(19, 'img/still/19_01.jpg'),
(19, 'img/still/19_02.jpg'),
(19, 'img/still/19_03.jpg'),
(19, 'img/still/19_04.jpg'),
(19, 'img/still/19_05.jpg'),
(20, 'img/still/20_01.jpg'),
(20, 'img/still/20_02.jpg'),
(20, 'img/still/20_03.jpg'),
(20, 'img/still/20_04.jpg'),
(20, 'img/still/20_05.jpg'),
(21, 'img/still/21_01.jpg'),
(21, 'img/still/21_02.jpg'),
(21, 'img/still/21_03.jpg'),
(21, 'img/still/21_04.jpg'),
(21, 'img/still/21_05.jpg'),
(22, 'img/still/22_01.jpg'),
(22, 'img/still/22_02.jpg'),
(22, 'img/still/22_03.jpg'),
(22, 'img/still/22_04.jpg'),
(22, 'img/still/22_05.jpg'),
(23, 'img/still/23_01.jpg'),
(23, 'img/still/23_02.jpg'),
(23, 'img/still/23_03.jpg'),
(23, 'img/still/23_04.jpg'),
(23, 'img/still/23_05.jpg'),
(24, 'img/still/24_01.jpg'),
(24, 'img/still/24_02.jpg'),
(24, 'img/still/24_03.jpg'),
(24, 'img/still/24_04.jpg'),
(24, 'img/still/24_05.jpg'),
(25, 'img/still/25_01.jpg'),
(25, 'img/still/25_02.jpg'),
(25, 'img/still/25_03.jpg'),
(25, 'img/still/25_04.jpg'),
(25, 'img/still/25_05.jpg'),
(26, 'img/still/26_01.jpg'),
(26, 'img/still/26_02.jpg'),
(26, 'img/still/26_03.jpg'),
(26, 'img/still/26_04.jpg'),
(26, 'img/still/26_05.jpg'),
(27, 'img/still/27_01.jpg'),
(27, 'img/still/27_02.jpg'),
(27, 'img/still/27_03.jpg'),
(27, 'img/still/27_04.jpg'),
(27, 'img/still/27_05.jpg'),
(28, 'img/still/28_01.jpg'),
(28, 'img/still/28_02.jpg'),
(28, 'img/still/28_03.jpg'),
(28, 'img/still/28_04.jpg'),
(28, 'img/still/28_05.jpg');

-- --------------------------------------------------------

--
-- 資料表結構 `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(20) CHARACTER SET utf8 NOT NULL COMMENT '真實姓名',
  `userAccount` varchar(20) CHARACTER SET utf8 NOT NULL COMMENT '使用者帳號',
  `userPassword` varchar(256) CHARACTER SET utf8 NOT NULL COMMENT '使用者密碼',
  `sex` varchar(1) CHARACTER SET utf8 NOT NULL COMMENT '性別',
  `dateOfBirth` date NOT NULL COMMENT '出生日期',
  `Email` varchar(50) CHARACTER SET utf8 NOT NULL COMMENT 'Email',
  `mobile` char(10) CHARACTER SET utf8 NOT NULL COMMENT '行動電話',
  `userNickname` varchar(30) CHARACTER SET utf8 NOT NULL COMMENT '站內使用的暱稱',
  `signUpDate` date NOT NULL COMMENT '註冊日期',
  `rank` enum('normal','admin') NOT NULL DEFAULT 'normal' COMMENT '權限分級(一般使用者, 管理者)'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 資料表的匯出資料 `user`
--

INSERT INTO `user` (`id`, `name`, `userAccount`, `userPassword`, `sex`, `dateOfBirth`, `Email`, `mobile`, `userNickname`, `signUpDate`, `rank`) VALUES
(1, '管理者大大', 'admin', 'A66ABB5684C45962D887564F08346E8D', 'M', '2018-06-01', 'godgodgogogo@gmail.com', '0929123456', '管理者大大在此', '2018-06-18', 'admin'),
(2, '測試用帳號1', 'member', '95125c133c134ac1169e91e322b93151', 'M', '2018-05-29', 'testMember@gmail.com', '0929123456', '測試用帳號暱稱在此', '2018-06-18', 'normal'),
(3, '李鴻J', 'pip6427', 'e10adc3949ba59abbe56e057f20f883e', 'M', '1997-10-14', 's0554038@gm.ncue.edu.tw', '0978671107', 'Saint', '2018-06-18', 'normal'),
(4, '吳定南', 'pip64272', 'e10adc3949ba59abbe56e057f20f883e', 'F', '2018-06-08', 's0554038@gm.ncue.edu.tw', '0978671107', 'Bald Brother', '2018-06-18', 'normal');

--
-- 已匯出資料表的索引
--

--
-- 資料表索引 `board`
--
ALTER TABLE `board`
  ADD PRIMARY KEY (`mes_id`);

--
-- 資料表索引 `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`userAccount`,`movieID`);

--
-- 資料表索引 `movie`
--
ALTER TABLE `movie`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `movieslider`
--
ALTER TABLE `movieslider`
  ADD PRIMARY KEY (`slider_id`);

--
-- 資料表索引 `moviestills`
--
ALTER TABLE `moviestills`
  ADD PRIMARY KEY (`id`,`still_path`);

--
-- 資料表索引 `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `userAccount` (`userAccount`);

--
-- 在匯出的資料表使用 AUTO_INCREMENT
--

--
-- 使用資料表 AUTO_INCREMENT `board`
--
ALTER TABLE `board`
  MODIFY `mes_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=141;

--
-- 使用資料表 AUTO_INCREMENT `movie`
--
ALTER TABLE `movie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- 使用資料表 AUTO_INCREMENT `movieslider`
--
ALTER TABLE `movieslider`
  MODIFY `slider_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- 使用資料表 AUTO_INCREMENT `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
