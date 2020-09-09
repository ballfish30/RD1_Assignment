<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>球魚氣象觀測站</title>
  <script src="/RD1_Assignment/js/jquery.min.js"></script>
  <style>
    table, th, td {
      border: 1px solid black;
    }
  </style>
</head>

<body>
<div class="c-zt-pic">
  <img id="preview" src="" style='width:100%; height:100%'>
</div>
<div>
  選擇縣市：
  <select id="stationCounty" style="width: 220px;">
    <option value="臺北市">臺北市 (TaipeiCity)</option>
    <option value="新北市">新北市 (NewTaipeiCity)</option>
    <option value="臺中市">臺中市 (TaichungCity)</option>
    <option value="臺南市">臺南市 (TainanCity)</option>
    <option value="高雄市">高雄市 (KaohsiungCity)</option>
    <option value="基隆市">基隆市 (KeelungCity)</option>
    <option value="桃園市">桃園市 (TaoyuanCity)</option>
    <option value="新竹市">新竹市 (HsinchuCity)</option>
    <option value="新竹縣">新竹縣 (HsinchuCounty)</option>
    <option value="苗栗縣">苗栗縣 (MiaoliCounty)</option>
    <option value="南投縣">南投縣 (NantouCounty)</option>
    <option value="彰化縣">彰化縣 (ChanghuaCounty)</option>
    <option value="雲林縣">雲林縣 (YunlinCounty)</option>
    <option value="嘉義市">嘉義市 (ChiayiCity)</option>
    <option value="嘉義縣">嘉義縣 (ChiayiCounty)</option>
    <option value="屏東縣">屏東縣 (PingtungCounty)</option>
    <option value="宜蘭縣">宜蘭縣 (YilanCounty)</option>
    <option value="花蓮縣">花蓮縣 (HualienCounty)</option>
    <option value="臺東縣">臺東縣 (TaitungCounty)</option>
    <option value="澎湖縣">澎湖縣 (PenghuCounty)</option>
    <option value="金門縣">金門縣 (KinmenCounty)</option>
    <option value="連江縣">連江縣 (LienchiangCounty)</option>
  </select>
</div>
<div id="weatherNow"></div>
<div id="weather2"></div>
<div id="weatherWeek"></div>
<br>
<div id="location"></div>
<br>
<div id="rainfallNow"></div>
<div id="rainfall24hr"></div>
</body>
<script>
  $(document).ready(function() {
    var dt = new Date();
    var $weatherNow = weatherNow.innerHTML;

    var imgs = {
      '基隆市':[
        '../img/基隆市/12_0001105_1.jpg', '../img/基隆市/12_0001105.jpg', '../img/基隆市/20_0001105.jpg'
      ],
      '臺北市':[
        '../img/臺北市/12_0001090_1.jpg', '../img/臺北市/20_0001090.jpg', '../img/臺北市/20_0001090_1.jpg'
      ],
      '新北市':[
        '../img/新北市/12_0001091_3.jpg', '../img/新北市/20_0001091.jpg', '../img/新北市/20_0001091_1.jpg'
      ],
      '宜蘭縣':[
        '../img/宜蘭縣/12_0001106_1.jpg', '../img/宜蘭縣/20_0001106.jpg'
      ],
      '新竹市':[
        '../img/新竹市/20_0001109.jpg'
      ],
      '新竹縣':[
        '../img/新竹縣/20_0001108.jpg'
      ],
      '桃園市':[
        '../img/桃園市/12_0001107_2.jpg', '../img/桃園市/20_0001107.jpg', '../img/桃園市/20_0001107_1.jpg'
      ],
      '苗栗縣':[
        '../img/苗栗縣/12_0001110.jpg', '../img/苗栗縣/12_0001110_1.jpg', '../img/苗栗縣/20_0001110.jpg'
      ],
      '臺中市':[
        '../img/臺中市/12_0001112_1.jpg', '../img/臺中市/20_0001112.jpg', '../img/臺中市/20_0001112_1.jpg'
      ],
      '彰化縣':[
        '../img/彰化縣/12_0001113_1.jpg', '../img/彰化縣/20_0001113.jpg'
      ],
      '南投縣':[
        '../img/南投縣/12_0001114.jpg', '../img/南投縣/12_0001114_1.jpg', '../img/南投縣/20_0001114.jpg'
      ],
      '嘉義市':[
        '../img/嘉義市/12_0001117.jpg', '../img/嘉義市/20_0001117.jpg'
      ],
      '嘉義縣':[
        '../img/嘉義縣/12_0001116_1.jpg', '../img/嘉義縣/12_0001116_2.jpg', '../img/嘉義縣/20_0001116.jpg'
      ],
      '雲林縣':[
        '../img/雲林縣/12_0001115.jpg', '../img/雲林縣/12_0001115_1.jpg', '../img/雲林縣/12_0001115_2.jpg'
      ],
      '臺南市':[
        '../img/臺南市/12_0001119_1.jpg', '../img/臺南市/20_0001119_1.jpg', '../img/臺南市/20_0001119_2.jpg'
      ],
      '高雄市':[
        '../img/高雄市/12_0001121.jpg', '../img/高雄市/12_0001121_1.jpg', '../img/高雄市/20_0001121.jpg', '../img/高雄市/20_0001121_1.jpg'
      ],
      '屏東縣':[
        '../img/屏東縣/12_0001122.jpg', '../img/屏東縣/12_0001122_1.jpg', '../img/屏東縣/20_0001122.jpg'
      ],
      '臺東縣':[
        '../img/臺東縣/12_0001123_1.jpg', '../img/臺東縣/12_0001123_2.jpg', '../img/臺東縣/12_0001123_3.jpg'
      ],
      '花蓮縣':[
        '../img/花蓮縣/12_0001124_4.jpg', '../img/花蓮縣/20_0001124_3.jpg', '../img/花蓮縣/20_0001124_5.jpg'
      ],
      '金門縣':[
        '../img/金門縣/20_0001126.jpg'
      ],
      '連江縣':[
        '../img/連江縣/12_0001127.jpg', '../img/連江縣/12_0001127_1.jpg', '../img/連江縣/20_0001127.jpg'
      ],
      '澎湖縣':[
        '../img/澎湖縣/12_0001125.jpg', '../img/澎湖縣/12_0001125_1.jpg', '../img/澎湖縣/20_0001125.jpg', '../img/澎湖縣/20_0001125_1.jpg'
      ]
    };

    var location = {
      '基隆市': {
        '基隆 (KEELUNG)': '466940',
        '彭佳嶼 (PENGJIAYU)': '466950',
        '七堵 (Qidu)': 'C0B010',
        '基隆嶼 (Keelung Islet)': 'C0B020'
      },
      '臺北市': {
        '鞍部 (ANBU)': '466910',
        '臺北 (TAIPEI)': '466920',
        '竹子湖 (ZHUZIHU)': '466930',
        '社子 (Shezih)': 'C0A980',
        '大直 (Dazhi)': 'C0A9A0',
        '天母 (Tianmu)': 'C0A9C0',
        '士林 (Shihlin)': 'C0A9E0',
        '內湖 (Neihu)': 'C0A9F0',
        '大屯山 (Datunshan)': 'C0AC40',
        '信義 (Xinyi)': 'C0AC70',
        '文山 (Wenshan)': 'C0AC80',
        '平等 (Pingdeng)': 'C0AH40',
        '松山 (Songshan)': 'C0AH70',
        '石牌 (Shipai)': 'C0AI40',
        '關渡 (Guandu)': 'C1AC50'
      },
      '新北市': {
        '板橋 (BANQIAO)': '466880',
        '淡水 (TAMSUI)': '466900',
        '山佳 (Shanjia)': 'C0A520',
        '坪林 (Pinglin)': 'C0A530',
        '四堵 (Sihdu)': 'C0A540',
        '泰平 (Taiping)': 'C0A550',
        '福山 (Fushan)': 'C0A560',
        '桶後 (Tonghou)': 'C0A570',
        '石碇 (Shihding)': 'C0A640',
        '火燒寮 (Huoshaoliao)': 'C0A650',
        '瑞芳 (Rueifang)': 'C0A660',
        '大坪 (Daping)': 'C0A860',
        '五指山 (Wujhihshan)': 'C0A870',
        '福隆 (Fulong)': 'C0A880',
        '雙溪 (Shuangsi)': 'C0A890',
        '富貴角 (Fugueijiao)': 'C0A920',
        '三和 (Sanhe)': 'C0A931',
        '金山 (Jinshan)': 'C0A940',
        '鼻頭角 (Bitoujiao)': 'C0A950',
        '三貂角 (Sandiaojiao)': 'C0A970',
        '三峽 (Sanshia)': 'C0AC60',
        '蘆洲 (Lujhou)': 'C0AD30',
        '土城 (Tucheng)': 'C0AD40',
        '鶯歌 (Yingge)': 'C0AD50',
        '中和 (Zhonghe)': 'C0AG90',
        '汐止 (Xizhi)': 'C0AH00',
        '永和 (Yonghe)': 'C0AH10',
        '五分山 (Wufengshan)': 'C0AH30',
        '林口 (Linkou)': 'C0AH50',
        '深坑 (Shenkeng)': 'C0AH80',
        '福山植物園 (Fushan Botanical Garden)': 'C0AH90',
        '五股 (Wugu)': 'C0AI00',
        '屈尺 (Quchi)': 'C0AI10',
        '白沙灣 (Baishawan)': 'C0AI20',
        '三重 (Sanchong)': 'C0AI30',
        '新莊 (Xinzhuang)': 'C0ACA0',
        '三芝 (Sanzhi)': 'C0AD00',
        '八里 (Bali)': 'C0AD10',
        '下盆 (Siapen)': 'C1A630',
        '四十份 (Sihshihfen)': 'C1A9N0'
      },
      '宜蘭縣': {
        '蘇澳 (SU-AO)': '467060',
        '宜蘭 (YILAN)': '467080',
        '雙連埤 (Shuanglianpi)': 'C0U520',
        '礁溪 (Chiaoshi)': 'C0U600',
        '玉蘭 (Yulan)': 'C0U650',
        '龜山島 (Gueishandao)': 'C0U750',
        '東澳 (Dong-ao)': 'C0U760',
        '南澳 (Nanao)': 'C0U770',
        '五結 (Wujie)': 'C0U780',
        '頭城 (Toucheng)': 'C0U860',
        '大礁溪 (Dajiaoxi)': 'C0U870',
        '三星 (Sanxing)': 'C0U890',
        '內城 (Neicheng)': 'C0U900',
        '冬山 (Dongshan)': 'C0U910',
        '羅東 (Luodong)': 'C0U940',
        '鶯子嶺 (Yingziling)': 'C0U950',
        '翠峰湖 (Cuifenghu)': 'C0U960',
        '大福 (Dafu)': 'C0U970',
        '坪林石牌 (Shipai Pinglin)': 'C0U980',
        '員山 (Yuanshan)': 'C0U990',
        '土場 (Tuchang)': 'C0UA00',
        '鴛鴦湖 (Yuanyanghu)': 'C0UA10',
        '多加屯 (Duojiatun)': 'C0UA20',
        '白嶺 (Bailing)': 'C0UA30',
        '西德山 (Xideshan)': 'C0UA40',
        '西帽山 (Ximaoshan)': 'C0UA50',
        '樟樹山 (Zhangshushan)': 'C0UA60',
        '桃源谷 (Taoyuangu)': 'C0UA70',
        '太平山 (Taipingshan)': 'C0U710',
        '南山 (Nanshan)': 'C0U720',
        '牛鬥 (Nioudou)': 'C1U501',
        '寒溪 (Hanxi)': 'C1U670',
        '新寮 (Xinliao)': 'C1U690',
        '烏石鼻 (Wushibi)': 'C1U830',
        '東澳嶺 (Dongaoling)': 'C1U840',
        '觀音海岸 (Guanyin Coast)': 'C1U850',
        '北關 (Beiguan)': 'C1U880',
        '思源 (Siyuan)': 'C1U920'
      },
      '新竹市': {
        '香山 (Siangshan)': 'C0D570',
        '新竹市東區 (Dongqu Hsinshu City)': 'C0D660'
      },
      '新竹縣': {
        '新竹 (HSINCHU)': '467571',
        '梅花 (Meihua)': 'C0D360',
        '關西 (Guanxi)': 'C0D390',
        '峨眉 (Emei)': 'C0D430',
        '打鐵坑 (Datiekeng)': 'C0D480',
        '橫山 (Hengshan)': 'C0D540',
        '雪霸 (Xueba)': 'C0D550',
        '竹東 (Zhudong)': 'C0D560',
        '寶山 (Baoshan)': 'C0D580',
        '新豐 (Sinfong)': 'C0D590',
        '湖口 (Hukou)': 'C0D650',
        '新埔 (Sinpu)': 'C1D380',
        '鳥嘴山 (Niaozueishan)': 'C1D400',
        '白蘭 (Bailan)': 'C1D410',
        '太閣南 (Taigenan)': 'C1D420',
        '飛鳳山 (Fei Feng Mountain)': 'C1D630',
        '外坪(五指山) (Waiping(Wuzhihshan))': 'C1D640'
      },
      '桃園市': {
        '新屋 (XINWU)': '467050',
        '復興 (Fuxing)': 'C0C460',
        '桃園 (Taoyuan)': 'C0C480',
        '八德 (Bade)': 'C0C490',
        '平鎮 (Pingjhen)': 'C0C650',
        '楊梅 (Yangmei)': 'C0C660',
        '龍潭 (Longtan)': 'C0C670',
        '龜山 (Guishan)': 'C0C680',
        '中壢 (Zhongli)': 'C0C700',
        '大溪永福 (Yongfu Daxi)': 'C0C710',
        '大園 (Dayuan)': 'C0C540',
        '觀音 (Guanyin)': 'C0C590',
        '蘆竹 (Luzhu)': 'C0C620',
        '大溪 (Dasi)': 'C0C630',
        '水尾 (Shueiwei)': 'C1C510'
      },
      '苗栗縣': {
        '竹南 (Jhunan)': 'C0E420',
        '南庄 (Nanzhuang)': 'C0E430',
        '大湖 (Dahu)': 'C0E520',
        '銅鑼 (Tongluo)': 'C0E780',
        '卓蘭 (Zhuolan)': 'C0E790',
        '西湖 (Xihu)': 'C0E810',
        '獅潭 (Shitan)': 'C0E820',
        '苑裡 (YUANLI)': 'C0E830',
        '大河 (Dahe)': 'C0E850',
        '高鐵苗栗 (THSR Miaoli)': 'C0E870',
        '三義 (Sanyi)': 'C0E880',
        '通霄 (Tongxiao)': 'C0E590',
        '馬都安 (Madu-an)': 'C0E610',
        '頭份 (Toufen)': 'C0E730',
        '造橋 (Zaoqiao)': 'C0E740',
        '苗栗 (Miaoli)': 'C0E750',
        '後龍 (Houlong)': 'C0E540',
        '明德 (Mingde)': 'C0E550',
        '象鼻 (Xiangbi)': 'C1E451',
        '新開 (Xinkai)': 'C1E511',
        '松安 (Song-an)': 'C1E461',
        '鳳美 (Fongmei)': 'C1E480',
        '南勢 (Nanshi)': 'C1E601',
        '南礦 (Nankuang)': 'C1E670',
        '南勢山 (Nanshishan)': 'C1E681',
        '南湖 (Nanhu)': 'C1E691',
        '八卦 (Bagua)': 'C1E701',
        '泰安 (Tai-an)': 'C1E721',
        '公館 (Gongguan)': 'C1E770',
        '馬拉邦山 (Malabangshan)': 'C1E711'
      },
      '臺中市': {
        '臺中 (TAICHUNG)': '467490',
        '梧棲 (WUQI)': '467770',
        '大肚 (Dadu)': 'C0F000',
        '雪山圈谷 (Xueshanjuangu)': 'C0F0A0',
        '石岡 (Shigang)': 'C0F0B0',
        '中坑 (Zhongkeng)': 'C0F0C0',
        '審馬陣 (Shenmazhen)': 'C0F0D0',
        '南湖圈谷 (Nanhuquangu)': 'C0F0E0',
        '東勢 (Dongshi)': 'C0F850',
        '梨山 (Lishan)': 'C0F861',
        '中竹林 (Zhongzhulin)': 'C0F9A0',
        '神岡 (Shengang)': 'C0F9I0',
        '大安 (Da-an)': 'C0F9K0',
        '后里 (Houli)': 'C0F9L0',
        '豐原 (Fengyuan)': 'C0F9M0',
        '大里 (Dali)': 'C0F9N0',
        '潭子 (Tanzi)': 'C0F9O0',
        '清水 (Qingshui)': 'C0F9P0',
        '外埔 (Waipu)': 'C0F9Q0',
        '龍井 (Longjing)': 'C0F9R0',
        '烏日 (Wuri)': 'C0F9S0',
        '西屯 (Xitun)': 'C0F9T0',
        '南屯 (Nantun)': 'C0F9U0',
        '新社 (Xinshe)': 'C0F9V0',
        '大雅(中科園區) (Daya)': 'C0F9X0',
        '桃山 (Taoshan)': 'C0F9Y0',
        '雪山東峰 (Xueshandongfeng)': 'C0F9Z0',
        '大甲 (Dajia)': 'C0F930',
        '大坑 (Dakeng)': 'C0F970',
        '上谷關 (Shangguguan)': 'C1F871',
        '新伯公 (Xinbogong)': 'C1F911',
        '雪嶺 (Xueling)': 'C1F941',
        '稍來 (Shaolai)': 'C1F891',
        '桐林 (Tonglin)': 'C1F9B1',
        '白冷 (Baileng)': 'C1F9C1',
        '白毛台 (Baimaotai)': 'C1F9D1',
        '龍安 (Long-an)': 'C1F9E1',
        '伯公龍 (Bogonglong)': 'C1F9F1',
        '清水林 (Qingshuilin)': 'C1F9J1',
        '德基 (Deji)': 'C1F9W0',
        '慶福山 (Cingfushan)': 'C1F9G1',
        '烏石坑 (Wushikeng)': 'C1F9H1'
      },
      '彰化縣': {
        '田中 (TianZhong)': '467270',
        '芬園 (Fenyuan)': 'C0G620',
        '鹿港 (Lukang)': 'C0G640',
        '員林 (Yuanlin)': 'C0G650',
        '溪湖 (Xihu)': 'C0G660',
        '社頭 (Shetou)': 'C0G860',
        '芳苑 (Fangyuan)': 'C0G870',
        '二水 (Ershui)': 'C0G880',
        '伸港 (Shenggang)': 'C0G890',
        '線西 (xianxi)': 'C0G900',
        '花壇 (Huatan)': 'C0G910',
        '溪州 (Xizhou)': 'C0G720',
        '二林 (Erlin)': 'C0G730',
        '大城 (Dacheng)': 'C0G740',
        '竹塘 (Zhutang)': 'C0G750',
        '高鐵彰化 (THSR Changhua)': 'C0G760',
        '福興 (Fuxing)': 'C0G770',
        '秀水 (Xiushui)': 'C0G780',
        '埔鹽 (Puyan)': 'C0G800',
        '埔心 (Puxin)': 'C0G810',
        '田尾 (Tianwei)': 'C0G820',
        '埤頭 (Pitou)': 'C0G830',
        '北斗 (Beidou)': 'C0G840',
        '下水埔 (Xiashuipu)': 'C1G691'
      },
      '南投縣': {
        '玉山 (YUSHAN)': '467550',
        '日月潭 (SUN MOON LAKE)': '467650',
        '埔里 (Puli)': 'C0H890',
        '中寮 (Zhongliao)': 'C0H950',
        '草屯 (Caotun)': 'C0H960',
        '昆陽 (Kunyang)': 'C0H990',
        '神木村 (Shenmu Village)': 'C0H9A0',
        '合歡山 (Hehuan Mountain)': 'C0H9C0',
        '廬山 (Lushan)': 'C0I010',
        '信義 (Xinyi)': 'C0I080',
        '鳳凰 (Fonghuang)': 'C0I090',
        '竹山 (Zhushan)': 'C0I110',
        '水里 (Shuili)': 'C0I360',
        '魚池 (Yuchi)': 'C0I370',
        '集集 (Jiji)': 'C0I380',
        '仁愛 (Ren\'ai)': 'C0I390',
        '名間 (Mingjian)': 'C0I410',
        '國姓 (Guoxing)': 'C0I420',
        '南投 (Nantou)': 'C0I460',
        '梅峰 (Meifeng)': 'C0I480',
        '萬大林道 (Wandalindao)': 'C0I490',
        '玉山風口 (Yushanfengkou)': 'C0I520',
        '小奇萊 (Xiaoqilai)': 'C0I530',
        '奇萊稜線 (Qilailengxian)': 'C0I540',
        '翠峰 (Cuifeng)': 'C1H000',
        '瑞岩 (Ruiyan)': 'C1H860',
        '清流 (Qingliu)': 'C1H900',
        '長豐 (Changfeng)': 'C1H920',
        '雙冬 (Shuangdong)': 'C1H941',
        '阿眉 (Amei)': 'C1H9B1',
        '萬大 (Wanda)': 'C1I020',
        '武界 (Wujie)': 'C1I030',
        '六分寮 (Liufenliao)': 'C1H971',
        '丹大 (Danda)': 'C1I050',
        '和社 (Heshe)': 'C1I070',
        '溪頭 (Xitou)': 'C1I101',
        '桶頭 (Tongtou)': 'C1I131',
        '卡奈托灣 (Kanaituowan)': 'C1I140',
        '青雲 (Qingyun)': 'C1I150',
        '大鞍 (Da-an)': 'C1I121',
        '中心崙 (Zhongxinlun)': 'C1I201',
        '凌霄 (Lingxiao)': 'C1I400',
        '翠華 (Cuihua)': 'C1I430',
        '新高口 (Xingaokou)': 'C1I440',
        '望鄉山 (Wangxiangshan)': 'C1I450',
        '杉林溪 (Shanlinxi)': 'C1I470',
        '大尖山 (Dajianshan)': 'C1I500',
        '線浸林道 (Xianjinlindao)': 'C1I510',
        '蘆竹湳 (Luzhunan)': 'C1I211',
        '樟湖 (Zhanghu)': 'C1I220',
        '九份二山 (Jiufen\'ershan)': 'C1I230',
        '外大坪 (Waidaping)': 'C1I240',
        '鯉潭 (Litan)': 'C1I250',
        '北坑 (Beikeng)': 'C1I260',
        '西巒 (Xiluan)': 'C1I310',
        '奧萬大 (Aowanda)': 'C1I320',
        '楓樹林 (Fengshulin)': 'C1I330',
        '新興橋 (Xinxingqiao)': 'C1I340',
        '埔中 (Puzhong)': 'C1I280',
        '豐丘 (Fengqiu)': 'C1I290'
      },
      '嘉義市': {
        '嘉義 (CHIAYI)': '467480',
        '嘉義市東區': 'C0M730'
      },
      '嘉義縣': {
        '阿里山 (ALISHAN)': '467530',
        '馬頭山 (Matoushan)': 'C0M410',
        '東後寮 (Donghouliao)': 'C0M520',
        '奮起湖 (Fenqihu)': 'C0M530',
        '中埔 (Zhongpu)': 'C0M640',
        '朴子 (Puzi)': 'C0M650',
        '溪口 (Xikou)': 'C0M660',
        '大林 (Dalin)': 'C0M670',
        '太保 (Taibao)': 'C0M680',
        '水上 (Shuishang)': 'C0M690',
        '竹崎 (Zhuqi)': 'C0M700',
        '東石 (Dongshi)': 'C0M710',
        '番路 (Fanlu)': 'C0M720',
        '六腳 (Liujiao)': 'C0M740',
        '布袋 (Budai)': 'C0M750',
        '民雄 (Minxiong)': 'C0M760',
        '嘉義梅山 (Meishan Chiayi County)': 'C0M770',
        '鹿草 (Lucao)': 'C0M780',
        '新港 (Xingang)': 'C0M790',
        '茶山 (Chashan)': 'C0M800',
        '里佳 (Lijia)': 'C0M810',
        '達邦 (Dabang)': 'C0M820',
        '表湖 (Biaohu)': 'C0M850',
        '新美 (Shinmei)': 'C0M860',
        '獨立山 (Dulishan)': 'C1M480',
        '龍美 (Longmei)': 'C1M390',
        '菜瓜坪 (Caiguaping)': 'C1M400',
        '頭凍 (Toudong)': 'C1M600',
        '石磐龍 (Shipanlong)': 'C1M610',
        '瑞里 (Ruili)': 'C1M620',
        '十字 (Shizi)': 'C1M640'
      },
      '雲林縣': {
        '草嶺 (Caoling)': 'C0K240',
        '崙背 (Lunbei)': 'C0K250',
        '四湖 (Sihu)': 'C0K280',
        '虎尾 (Huwei)': 'C0K330',
        '土庫 (Tuku)': 'C0K390',
        '斗六 (Douliu)': 'C0K400',
        '北港 (Beigang)': 'C0K410',
        '西螺 (Xiluo)': 'C0K420',
        '褒忠 (Baozhong)': 'C0K430',
        '二崙 (Erlun)': 'C0K440',
        '大埤 (Dapi)': 'C0K450',
        '斗南 (Dounan)': 'C0K460',
        '林內 (Linnei)': 'C0K470',
        '莿桐 (Citong)': 'C0K480',
        '古坑 (Gukeng)': 'C0K490',
        '元長 (Yuanchang)': 'C0K500',
        '水林 (Shuilin)': 'C0K510',
        '雲林東勢 (Dongshi Yunlin County)': 'C0K520',
        '臺西 (Taixi)': 'C0K530',
        '蔦松 (Niaosong)': 'C0K550',
        '棋山 (Qishan)': 'C0K560',
        '高鐵雲林 (THSR Yunlin)': 'C0K580',
        '宜梧 (Yiwu)': 'C0K291',
        '口湖 (Kouhu)': 'C1K540'
      },
      '臺南市': {
        '臺南 (TAINAN)': '467410',
        '永康 (YONGKANG)': '467420',
        '玉井 (Yujing)': 'C0O930',
        '安南 (Annan)': 'C0O950',
        '崎頂 (Qiding)': 'C0O960',
        '虎頭埤 (Hutoupi)': 'C0O970',
        '新市 (Xinshi)': 'C0O980',
        '媽廟 (Mamiao)': 'C0O990',
        '曾文 (Cengwen)': 'C0O810',
        '北寮 (Beiliao)': 'C0O830',
        '王爺宮 (Wangyegong)': 'C0O840',
        '大內 (Danei)': 'C0O860',
        '善化 (Shanhua)': 'C0O900',
        '東河 (Donghe)': 'C0X050',
        '下營 (Xiaying)': 'C0X060',
        '佳里 (Jiali)': 'C0X080',
        '臺南市北區 (Beiqu Tainan City)': 'C0X100',
        '臺南市南區 (Nanqu Tainan City)': 'C0X110',
        '麻豆 (Madou)': 'C0X120',
        '官田 (Guantian)': 'C0X130',
        '西港 (Xigang)': 'C0X140',
        '安定 (Anding)': 'C0X150',
        '仁德 (Rende)': 'C0X160',
        '關廟 (Guanmiao)': 'C0X170',
        '山上 (Shanshang)': 'C0X180',
        '安平 (Anping)': 'C0X190',
        '左鎮 (Zuozhen)': 'C0X200',
        '白河 (Baihe)': 'C0X210',
        '學甲 (Xuejia)': 'C0X220',
        '鹽水 (Yanshui)': 'C0X230',
        '關子嶺 (Guanziling)': 'C0X240',
        '新營 (Xinying)': 'C0X250',
        '後壁 (Houbi)': 'C0X260',
        '將軍 (Jiangjun)': 'C0X280',
        '北門 (Beimen)': 'C0X290',
        '鹿寮 (Luliao)': 'C0X300',
        '七股 (Qigu)': 'C0X310',
        '柳營 (Liuying)': 'C0X320',
        '沙崙 (Shalun)': 'C1N001',
        '楠西 (Nanxi)': 'C1O921',
        '環湖 (Huanhu)': 'C1O850',
        '大棟山 (Dadongshan)': 'C1O870',
        '關山 (Guanshan)': 'C1O880',
        '東原 (Dongyuan)': 'C1X040'
      },
      '高雄市': {
        '高雄 (KAOHSIUNG)': '467440',
        '復興 (Fuxing)': 'C0V210',
        '甲仙 (Jiasian)': 'C0V250',
        '月眉 (Yuemei)': 'C0V260',
        '美濃 (Meinong)': 'C0V310',
        '溪埔 (XIPU)': 'C0V350',
        '內門 (Neimen)': 'C0V360',
        '古亭坑 (Gutingkeng)': 'C0V370',
        '阿公店 (Agongdian)': 'C0V400',
        '鳳山 (Fengshan)': 'C0V440',
        '鳳森 (Fengsen)': 'C0V450',
        '新興 (Sinsing)': 'C0V490',
        '旗津 (Cijin)': 'C0V500',
        '阿蓮 (Alian)': 'C0V530',
        '梓官 (Ziguan)': 'C0V610',
        '永安 (Yong\'an)': 'C0V620',
        '茄萣 (Qieding)': 'C0V630',
        '湖內 (Hunei)': 'C0V640',
        '彌陀 (Mituo)': 'C0V650',
        '岡山 (Gangshan)': 'C0V660',
        '楠梓 (Nanzi)': 'C0V670',
        '仁武 (Renwu)': 'C0V680',
        '鼓山 (Gushan)': 'C0V690',
        '三民 (Sanmin)': 'C0V700',
        '苓雅 (LingYa)': 'C0V710',
        '林園 (Linyuan)': 'C0V720',
        '大寮 (Daliao)': 'C0V730',
        '旗山 (Qishan)': 'C0V740',
        '路竹 (Luzhu)': 'C0V750',
        '橋頭 (Qiaotou)': 'C0V760',
        '大社 (Dashe)': 'C0V770',
        '萬山 (Wanshan)': 'C0V790',
        '六龜 (Liugui)': 'C0V800',
        '左營 (Zuoying)': 'C0V810',
        '小林 (Xiaolin)': 'C0V820',
        '達卡努瓦 (Dakanuwa)': 'C1V160',
        '排雲 (Paiyun)': 'C1V170',
        '南天池 (Nantianchi)': 'C1V190',
        '梅山 (Meishan)': 'C1V200',
        '小關山 (Xiaoguanshan)': 'C1V220',
        '高中 (Gaozhong)': 'C1V231',
        '大津 (Dajin)': 'C1V340',
        '尖山 (Jianshan)': 'C1V390',
        '吉東 (JiaDong)': 'C1V570',
        '溪南(特生中心) (Xinan)': 'C1V580',
        '新發 (Xinfa)': 'C1V590',
        '藤枝 (Tengzhi)': 'C1V600',
        '多納林道 (Duonalindao)': 'C1V780',
        '御油山 (Yuyoushan)': 'C1V300'
      },
      '屏東縣': {
        '恆春 (HENGCHUN)': '467590',
        '尾寮山 (Weiliaoshan)': 'C0R100',
        '阿禮 (Ali)': 'C0R130',
        '瑪家 (Majia)': 'C0R140',
        '三地門 (Sandimen)': 'C0R150',
        '鹽埔新圍 (yanpuxinwei)': 'C0R160',
        '屏東 (Pingdong)': 'C0R170',
        '赤山 (Chishan)': 'C0R190',
        '潮州 (Chaojhou)': 'C0R220',
        '來義 (Laiyi)': 'C0R240',
        '春日 (Chunri)': 'C0R260',
        '琉球嶼 (Liouciouyu)': 'C0R270',
        '檳榔 (Binlang)': 'C0R280',
        '車城 (Checheng)': 'C0R320',
        '牡丹 (Mudan)': 'C0R341',
        '貓鼻頭 (Maobitou)': 'C0R350',
        '萬丹 (WanDan)': 'C0R510',
        '崁頂 (Kanding)': 'C0R520',
        '林邊 (Linbian)': 'C0R530',
        '佳冬 (Jiadong)': 'C0R540',
        '新埤 (Xinpi)': 'C0R550',
        '新園 (Xinyuan)': 'C0R560',
        '麟洛 (Linluo)': 'C0R570',
        '南州 (Nanzhou)': 'C0R580',
        '里港 (Ligang)': 'C0R590',
        '舊泰武 (Jiutaiwu)': 'C0R600',
        '墾雷 (Kenlei)': 'C0R620',
        '東港 (Donggang)': 'C0R640',
        '竹田 (Zhutian)': 'C0R650',
        '枋寮 (Fangliao)': 'C0R660',
        '楓港 (Fenggang)': 'C0R670',
        '佳樂水 (Jialeshui)': 'C0R680',
        '墾丁 (Kenting)': 'C0R690',
        '枋山 (Fangshan)': 'C0R700',
        '龍磐 (Longpan)': 'C0R710',
        '旭海 (Xuhai)': 'C0R720',
        '大坪頂 (Dapingding)': 'C0R730',
        '獅子 (Shizi)': 'C0R740',
        '四林格山 (Silingeshan)': 'C0R750',
        '南仁湖 (Nanrenhu)': 'C0R760',
        '保力 (Baoli)': 'C0R770',
        '滿州 (Manzhou)': 'C0R780',
        '九棚 (Jiupeng)': 'C0R790',
        '丹路 (Danlu)': 'C0R800',
        '內獅 (Neishi)': 'C0R810',
        '白鷺 (Bailu)': 'C0R820',
        '高士 (Gaoshi)': 'C0R830',
        '牡丹池山 (Mudanchisahn)': 'C0R840',
        '大漢山 (Dahanshan)': 'C0R440',
        '高樹 (Gaoshu)': 'C0R470',
        '長治 (Changzhi)': 'C0R480',
        '九如 (Jiuru)': 'C0R490',
        '口社 (Gusia)': 'C1R110',
        '上德文 (Shangdewun)': 'C1R120',
        '石門山 (Shihmenshan)': 'C1R290',
        '西大武山 (Xidawushan)': 'C1R610',
        '龍泉 (Longquan)': 'C1R630',
        '力里 (Lili)': 'C1R250'
      },
      '臺東縣': {
        '大武 (DAWU)': '467540',
        '成功 (CHENGGONG)': '467610',
        '蘭嶼 (LANYU)': '467620',
        '臺東 (TAITUNG)': '467660',
        '下馬 (Xiama)': 'C0S660',
        '太麻里 (Taimali)': 'C0S690',
        '知本 (Jhihben)': 'C0S700',
        '鹿野 (Luye)': 'C0S710',
        '綠島 (Ludao)': 'C0S730',
        '池上 (Chihshang)': 'C0S740',
        '向陽 (Siangyang)': 'C0S750',
        '紅石 (Hongshih)': 'C0S760',
        '大溪山 (Dasishan)': 'C0S770',
        '金崙 (Jinlun)': 'C0S790',
        '東河 (Donghe)': 'C0S810',
        '長濱 (Changbin)': 'C0S830',
        '南田 (Nantian)': 'C0S840',
        '關山 (Guanshan)': 'C0S890',
        '蘭嶼高中 (Lanyu High School)': 'C0S900',
        '蘭嶼燈塔 (Lanyu Lighthouse)': 'C0S910',
        '金峰嘉蘭 (Jialan Jinfeng)': 'C0S920',
        '延平 (Yanping)': 'C0S930',
        '石寧山 (Shiningshan)': 'C0S940',
        '七塊厝 (Qikuaicuo)': 'C0S950',
        '香蘭 (Xianglan)': 'C0S960',
        '加津林 (Jiajinlin)': 'C0S970',
        '勝林山 (Shenglinshan)': 'C0S980',
        '山豬窟 (Shanzhuku)': 'C0S990',
        '歷坵 (Liqiu)': 'C0SA00',
        '檳榔四格山 (Binlangsigeshan)': 'C0SA10',
        '金崙山 (Jinlunshan)': 'C0SA20',
        '都歷 (Duli)': 'C0SA30',
        '瑞和 (Ruihe)': 'C0SA40',
        '知本（水試所） (Zhiben (FRI))': 'C0SA60',
        '土坂 (Tuban)': 'C0SA80',
        '達仁林場 (Darenlinchang)': 'C0SA90',
        '摩天 (Motian)': 'C1S670',
        '華源 (Huayuan)': 'C1S800',
        '金峰 (Jinfeng)': 'C1S820',
        '利嘉 (LiChai)': 'C1S860',
        '南美山 (NanMaiSan)': 'C1S870',
        '壽卡 (Shouka)': 'C1S880',
        '利嘉林道 (Lijialindao)': 'C1SA50',
        '都蘭 (Dulan)': 'C1SA70'
      },
      '花蓮縣': {
        '花蓮 (HUALIEN)': '466990',
        '大禹嶺 (Dayuling)': 'C0T790',
        '天祥 (Tianxiang)': 'C0T820',
        '和中 (Hezhong)': 'C0T9D0',
        '大坑 (Dakeng)': 'C0T9E0',
        '水璉 (Shuilian)': 'C0T9F0',
        '鳳林山 (Fenglinshan)': 'C0T9G0',
        '加路蘭山 (Jialulanshan)': 'C0T9H0',
        '豐濱 (Fengbin)': 'C0T9I0',
        '靜浦 (Jingpu)': 'C0T9M0',
        '富里 (Fuli)': 'C0T9N0',
        '鯉魚潭 (Liyutan)': 'C0T870',
        '西林 (Xilin)': 'C0T900',
        '光復 (Guangfu)': 'C0T960',
        '月眉山 (Yuemeishan)': 'C0T9A0',
        '水源 (Shuiyuan)': 'C0T9B0',
        '明里 (Mingli)': 'C0Z020',
        '佳心 (Jiaxin)': 'C0Z050',
        '玉里 (Yuli)': 'C0Z061',
        '舞鶴 (Wuhe)': 'C0Z070',
        '富源 (Fuyuan)': 'C0Z080',
        '東華 (Donghwa)': 'C0Z100',
        '吉安光華 (Guanghua Ji-an)': 'C0Z150',
        '鳳林 (Fenglin)': 'C0Z160',
        '卓溪 (Zhuoxi)': 'C0Z170',
        '新城 (Xincheng)': 'C0Z180',
        '富世 (Fushi)': 'C0Z190',
        '萬榮 (Wanrong)': 'C0Z200',
        '瑞穗 (Ruisui)': 'C0Z210',
        '和平林道 (Hepinglindao)': 'C0Z220',
        '和平 (Heping)': 'C0Z230',
        '瑞穗林道 (Ruisuilindao)': 'C0Z250',
        '蕃薯寮 (Fanshuliao)': 'C0Z270',
        '德武 (Dewu)': 'C0Z280',
        '赤柯山 (Chikeshan)': 'C0Z290',
        '東里 (Dongli)': 'C0Z300',
        '清水斷崖 (Qingshui Cliff)': 'C0Z310',
        '清水林道 (Qingshuilindao)': 'C0Z320',
        '安通山 (Antongshan)': 'C0Z330',
        '豐南 (Funan)': 'C1S850',
        '洛韶 (Luoshao)': 'C1T800',
        '慈恩 (Ci-en)': 'C1T810',
        '布洛灣 (Buluowan)': 'C1T830',
        '中興 (Zhongxing)': 'C1T920',
        '大觀 (Daguan)': 'C1T940',
        '太安 (Tai-an)': 'C1T950',
        '大農 (Danong)': 'C1T970',
        '龍澗 (Longjian)': 'C1T980',
        '高寮 (Gaoliao)': 'C1T990',
        '太魯閣 (Taroko)': 'C1TA00',
        '紅葉 (Hongye)': 'C1Z030',
        '立山 (Lishan)': 'C1Z040',
        '三棧 (Sanzhan)': 'C1Z110',
        '壽豐 (Shoufeng)': 'C1Z120',
        '銅門 (Tongmen)': 'C1Z130',
        '荖溪 (Laoxi)': 'C1Z140',
        '中平林道 (Zhongpinglindao)': 'C1Z240'
      },
      '金門縣': {
        '金門 (KINMEN)': '467110',
        '金沙 (Jinsha)': 'C0W140',
        '金寧 (Jinning)': 'C0W150'
      },
      '連江縣': {
        '馬祖 (MATSU)': '467990',
        '東莒 (Dongju)': 'C0W110'
      },
      '澎湖縣': {
        '東吉島 (DONGJIDAO)': '467300',
        '澎湖 (PENGHU)': '467350',
        '西嶼 (Xiyu)': 'C0W120',
        '花嶼 (Huayu)': 'C0W130'
      },
    };

    $("#stationCounty").on("change", function() {
      $this = $(this);
      $select = '選擇觀測站：<select id="observatory" style="width: 220px;">';
      $option = '';
      
      max = imgs[$this.val()].length - 1;
      random = Math.floor(Math.random() * (max - 0 + 1)) + 0;
      path = imgs[$this.val()][random];
      document.getElementById('preview').src = path;

      for(i in location[$this.val()]){
        $option += '<option value='+ location[$this.val()][i] +'>'+ i +'</option>'
      }
      $select += $option;
      $select += '</select>';
      $('#location').html($select);
      // 獲取今天天氣預報
      $.ajax({
        type:"GET",
        url:"http://localhost:8888/RD1_Assignment/weather/todayWeather?locationName="+$this.val()
      })
      .done(function (data) {
        $data = JSON.parse(data);
        $html = '<table>\
                  <tr>\
                    <th>縣市</th><th>日期</th><th>降雨機率</th><th>溫度</th><th>詳細內容</th>\
                  </tr>\
                  <tr>\
                    <td>'+$data[0]['locationName']+'</td><td>'+$data[0]['startDatetime']+'-'+$data[0]['endDatetime']+'</td><td>'+$data[0]['pop']+'％</td><td>'+$data[0]['MinT']+'度-'+$data[0]['MaxT']+'度</td><td>'+$data[0]['weatherDescription']+'</td>\
                  </tr>\
                </table>'
        $('#weatherNow').html("目前天氣：<br>"+$html)
      })

      // 獲取未來兩天天氣預報
      $.ajax({
        type:"GET",
        url:"http://localhost:8888/RD1_Assignment/weather/tomorrowWeather?locationName="+$this.val()
      })
      .done(function (data) {
        $data = JSON.parse(data);
        $weather = '';
        for(weather of $data){
          $weather += '<tr><td>'+weather['locationName']+'</td><td>'+weather['startDatetime']+'-'+weather['endDatetime']+'</td><td>'+weather['pop']+'％</td><td>'+weather['MinT']+'度-'+weather['MaxT']+'度</td><td>'+weather['weatherDescription']+'</td></tr>'
        }
        $html = '<table>\
                  <tr>\
                    <th>縣市</th><th>日期</th><th>降雨機率</th><th>溫度</th><th>詳細內容</th>\
                  </tr>\
                    '+$weather+'\
                </table>'
        $('#weather2').html("未來2天天氣預報：<br>"+$html)
      })

      // 抓取未來一週天氣預報
      $.ajax({
        type:"GET",
        url:"http://localhost:8888/RD1_Assignment/weather/weekWeather?locationName="+$this.val()
      })
      .done(function (data) {
        $data = JSON.parse(data);
        $weather = '';
        for(weather of $data){
          $weather += '<tr><td>'+weather['locationName']+'</td><td>'+weather['startDatetime']+'-'+weather['endDatetime']+'</td><td>'+weather['pop']+'％</td><td>'+weather['MinT']+'度-'+weather['MaxT']+'度</td><td>'+weather['weatherDescription']+'</td></tr>'
        }
        $html = '<table>\
                  <tr>\
                    <th>縣市</th><th>日期</th><th>降雨機率</th><th>溫度</th><th>詳細內容</th>\
                  </tr>\
                    '+$weather+'\
                </table>'
        $('#weatherWeek').html("未來一週天氣預報：<br>"+$html)
      })
      observatoryLoading()
      $("#observatory").change();
    })
    function observatoryLoading(){
      $("#observatory").on("change", function() {
        $this = $(this);
        $.ajax({
          type:"GET",
          url:"http://localhost:8888/RD1_Assignment/weather/rainfallNow?stationID="+$this.val()
        })
        .done(function (data) {
          $data = JSON.parse(data);
          $html = '<table>\
                    <tr>\
                      <th>觀測站</th><th>代號</th><th>每小時降雨量</th>\
                    </tr>\
                      <td>'+$data[0]['locationName']+'</td>\
                      <td>'+$data[0]['stationId']+'</td>\
                      <td>'+$data[0]['elementValue']+'</td>\
                  </table>'
          $('#rainfallNow').html("每小時降雨量：<br>"+$html)
        })
        $.ajax({
          type:"GET",
          url:"http://localhost:8888/RD1_Assignment/weather/rainfall24hr?stationID="+$this.val()
        })
        .done(function (data) {
          $data = JSON.parse(data);
          $html = '<table>\
                    <tr>\
                      <th>觀測站</th><th>代號</th><th>24小時降雨量</th>\
                    </tr>\
                      <td>'+$data[0]['locationName']+'</td>\
                      <td>'+$data[0]['stationId']+'</td>\
                      <td>'+$data[0]['elementValue']+'</td>\
                  </table>'
          $('#rainfall24hr').html("24小時降雨量：<br>"+$html)
        })
      })
    }
    $("#stationCounty").change();
  });
</script>
</html>