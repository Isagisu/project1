<?php
error_reporting(0);
session_start();
require "./config/connect.php";
require "./Function.php";

if (isset($_SESSION["login_session"]) && $_SESSION["login_session"] == true) {
  $user = $_SESSION["profile"];
  $row = GetUser($user);
  $userimg = $row['profile'];
  $uuid = $row["uuid"];
  $userid = $row["userid"];
  $nickname = $row["nickname"];
  $email = $row["email"];
  $regdate = $row["regdate"];
  $birthday = $row["birthday"];
  $friend = $link->query("SELECT * FROM `friends` inner join account where friends.friend_uuid=account.uuid and status=1 and friends.uuid='$uuid'");

  $se = $link->query("SELECT * FROM session WHERE uuid = '$uuid'");

  $friends_online = [];
  $friends_offline = [];
  if ($friend->rowCount() > 0) {
    while ($fd = $friend->fetch()) {
      $friend_uuid = $fd["friend_uuid"];
      // 使用朋友的 UUID 查詢 session 資料
      $session = $link->query("SELECT * FROM session WHERE uuid = '$friend_uuid'");

      // 條件判斷儲存每個朋友的 ID 資料
      if ($session->rowCount() > 0)
        $friends_online[] = $fd["nickname"];
      else
        $friends_offline[] = $fd["nickname"];
    }
  }
  // 將結果轉為 JSON
} else {
  if ($_SERVER['HTTP_REFERER'] == "") {
    header("Location: index.php");
    exit;
  }
}
?>
<!DOCTYPE html>
<html lang="zh-Hant-TW">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>個人頁面</title>

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
    integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />

  <link rel="shortcut icon" href="./img/Alolan Marowak.png">
  <link rel="stylesheet" href="./css/style.css"> <!-- base       -->
  <link rel="stylesheet" href="./css/topnav.css"> <!-- topnav     -->
  <link rel="stylesheet" href="./css/sidebar.css"> <!-- sidebar    -->
  <link rel="stylesheet" href="./css/main.css"> <!-- main       -->
  <link rel="stylesheet" href="./css/profile.css" />
  <!-- component style  -->
  <link rel="stylesheet" href="./css/slider.css">
  <link rel="stylesheet" href="./css/notifications.css">
  <link rel="stylesheet" href="./css/dropdown.css">
  <!-- SweetAlert2  -->
  <link href='https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.min.css' rel='stylesheet'>
  <!-- <link rel="stylesheet" href="./css/loading.css"> -->
  <!-- Bootstrap v5.3.3 min.css -->
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap-grid.css' />
  <!-- Bootstrap v5.3.3 min.css -->
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap-utilities.css' />
  <!-- Bootstrap Icons -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <script src="https://kit.fontawesome.com/81c16f2f84.js" crossorigin="anonymous"></script>

  <!-- React -->
  <script crossorigin src="https://unpkg.com/react@18/umd/react.production.min.js"></script>
  <script crossorigin src="https://unpkg.com/react-dom@18/umd/react-dom.production.min.js"></script>
  <script crossorigin src="https://unpkg.com/babel-standalone@6.26.0/babel.min.js"></script>

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
    integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>

<body>
  <div class="f-container">
    <?php include('./templates/topnav.php') ?>
    <main class="main">
      <?php include('./templates/sidebar.php'); ?>
      <section id="profile"></section>
    </main>

    <script type="text/babel">
      const Bookmark = () => {
        const ObjectList = {
          1: '案例以來，怎麼會輕鬆眼中提問，認定下載，第二尊重，啟動提問。',
          2: '成立試驗對此實際事情運動難道千萬友情連結分鐘我這聯繫方式教。',
          3: '我也告知書庫，解壓密碼精品右鍵讓他，信箱有可能股權零售一看。',
          4: '中間想到很熱字元，好多上漲圖書館不在機器你沒有看不到編號不。',
          5: '都沒灌水充滿顏色，不管大多數毫不指南，奇怪股份有限公司辦理。',
          6: '案例以來，怎麼會輕鬆眼中提問，認定下載，第二尊重，啟動提問。',
          7: '成立試驗對此實際事情運動難道千萬友情連結分鐘我這聯繫方式教。',
          8: '我也告知書庫，解壓密碼精品右鍵讓他，信箱有可能股權零售一看。',
          9: '中間想到很熱字元，好多上漲圖書館不在機器你沒有看不到編號不。',
          10: '都沒灌水充滿顏色，不管大多數毫不指南，奇怪股份有限公司辦理。',
        };
        return (
          <div className="item-content-wrap">
            <ol>
              {Object.entries(ObjectList).map(([key, value]) => (
                <li key={key} value={key}>
                  {value}
                </li>
              ))}
            </ol>
          </div>
        );
      };


      const Friend = () => {
        // 狀態：管理每個群組是否展開
        const [openGroups, setOpenGroups] = React.useState({});

        // 切換群組展開/收合狀態
        const toggleGroup = (index) => {
          setOpenGroups((prev) => ({
            ...prev,
            [index]: !prev[index],
          }));
        };

        // 好友群組列表
        const friendGroups = [
          {
            name: '線上',
            friends: [
              <?php echo json_encode($friends_online); ?>
            ],
          },
          {
            name: '離線',
            friends: [
              <?php echo json_encode($friends_offline); ?>
            ],
          },
        ];

        return (
          <div className="item-content-wrap">
            <div className="friend-wrap">
              {/* 標題區域 */}
              <div className="friend-header">
                <div className="friend-title">好友名單</div>
                <div className="friend-navbar">
                  <button type="button">好友</button>
                  <button type="button">訊息</button>
                  <button type="button">查詢好友</button>
                  <button type="button">好友動態</button>
                  <button type="button">黑名單</button>
                </div>
              </div>

              {/* 好友群組內容 */}
              <div className="friend-content">
                {friendGroups.map((group, index) => (
                  <div key={index} className="friend-group">
                    {/* 群組標題（點擊切換展開） */}
                    <div
                      className="group-button"
                      onClick={() => toggleGroup(index)}
                    >
                      <span className="selected">{group.name}</span>
                      <div
                        className={`caret ${
                          openGroups[index] ? 'caret-rotate' : ''
                        }`}
                      ></div>
                    </div>

                    {/* 好友列表，動態顯示 */}
                    <div
                      className={`group-list ${
                        openGroups[index] ? 'list-open' : ''
                      }`}
                    >
                      <div>
                        {group.friends.map((friend, i) => (
                          <div key={i} className="group-item">
                            {friend}
                          </div>
                        ))}
                      </div>
                    </div>
                  </div>
                ))}
              </div>
            </div>
          </div>
        );
      };


      const EditProfile = () => {
        const [formData, setFormData] = React.useState({
          oldPassword: '',
          newPassword: '',
          confirmPassword: '',
        });

        const handleChange = (e) => {
          const { name, value } = e.target;
          setFormData((prev) => ({ ...prev, [name]: value }));
        };

        const handleSubmit = (e) => {
          e.preventDefault();
          if (formData.newPassword !== formData.confirmPassword) {
            alert('新密碼與確認密碼不匹配！');
            return;
          }
          alert('資料已更新！');
        };

        return (
          <div className="item-content-wrap">
            <div className="edit-profile">
              <h3>修改個人資料</h3>
              <div className="profile-list">姓名 <?php echo $userid ?>1</div>
              <div className="profile-list">生日 <?php echo $birthday ?></div>
              <div className="profile-list">信箱 <?php echo $email ?></div>
              <div className="profile-list">註冊日期 <?php echo $regdate ?></div>
            </div>

            <form onSubmit={handleSubmit}>
              <fieldset>
                <legend><span>🔒 變更密碼</span></legend>
                <label>輸入原本的密碼</label>
                <input
                  type="password"
                  name="oldPassword"
                  value={formData.oldPassword}
                  onChange={handleChange}
                  placeholder="輸入原本的密碼"
                />
                <label>輸入新密碼</label>
                <input
                  type="password"
                  name="newPassword"
                  value={formData.newPassword}
                  onChange={handleChange}
                  placeholder="輸入新密碼"
                />
                <label>再次確認新密碼</label>
                <input
                  type="password"
                  name="confirmPassword"
                  value={formData.confirmPassword}
                  onChange={handleChange}
                  placeholder="再次輸入新密碼"
                />
                <button type="submit">確認變更密碼</button>
              </fieldset>
            </form>
          </div >
        );
      };


      const Setting = () => (
        <div className="item-content-wrap">這是設定頁面。</div>
      );

      const Main = () => {
        {/*
        const getPath = () => {
          const path = window.location.pathname.slice(1);
          return path || "editProfile";
        };

        const [page, setPage] = React.useState(getPath());

        const navigate = (newPage) => {
          setPage(newPage);
          window.history.pushState({}, "", `/${newPage}`);
        };

        React.useEffect(() => {
          const handlePopState = () => setPage(getPath());
          window.addEventListener("popstate", handlePopState);
          return () => window.removeEventListener("popstate", handlePopState);
        }, []);
        */}

        const tabs = [
          {name: "個人資料", icon: "fa-user-edit", content: <EditProfile />},
          {name: "好友", icon: "fa-user-group", content: <Friend />},
          {name: "收藏", icon: "fa-bookmark", content: <Bookmark />},
          {name: "設定", icon: "fa-gear", content: <Setting />},
        ]

        const [activeTab, setActiveTab] = React.useState(0);

        return (
          <div className="profile">
            <header className="profile-item">
              <div className="item-user">
                <div className="user-img">
                  <div className="user">
                    <a href="#">
                      <img src="<?php echo $userimg ?>" alt="" />
                    </a>
                  </div>
                  <i className="fa-solid fa-pencil" />
                </div>
                <div className="user-info">
                  <div className="user-id">#<?php echo $userid ?></div>
                  <div className="user-nick">
                    <?php echo $nickname; ?><br />
                  </div>
                </div>
                <i className="fa-solid fa-pencil" />
              </div>
            </header>

            <div className="dividing-line"></div>

            <main className="profile-item">
              <div className="item-wrap">
                <div className="link-item-wrap">
                  {tabs.map((tab, index) => (
                    <a
                      key={index}
                      onClick={() => setActiveTab(index)}
                      title={tab.name}
                    >
                      <div className="link-item">
                        <i className={`fa-solid ${tab.icon}`}></i>{tab.name}
                      </div>
                    </a>
                  ))}
                  {/*
                  <a href="/editProfile" onClick={(e) => { e.preventDefault(); navigate("editProfile"); }} title="個人資料">
                    <div className="link-item">
                      <i className="fa-solid fa-user-edit" />個人資料
                    </div>
                  </a>
                  <a href="/friend" onClick={(e) => { e.preventDefault(); navigate("friend"); }} title="好友">
                    <div className="link-item"><i className="fa-solid fa-user-group" />好友</div>
                  </a>
                  <a href="/bookmark" onClick={(e) => { e.preventDefault(); navigate("bookmark"); }} title="收藏">
                    <div className="link-item"><i className="fa-solid fa-bookmark" />收藏</div>
                  </a>
                  <a href="/setting" onClick={(e) => { e.preventDefault(); navigate("setting"); }} title="設定">
                    <div className="link-item"><i className="fa-solid fa-gear" />設定</div>
                  </a>
                  */}
                </div>
                {/*
                {page === "editProfile" && <EditProfile />}
                {page === 'friend' && <Friend />}
                {page === 'bookmark' && <Bookmark />}
                {page === 'setting' && <Setting />}
                */}
                {tabs[activeTab].content}
              </div>
            </main>
          </div>
        );
      };

      ReactDOM.render(<Main />, document.getElementById('profile'));
    </script>
    <!-- footer -->
    <?php require("footer.php") ?>
  </div>

  <script src="./js/new-carousel.js"></script>
  <script src="./js/script.js"></script>
  <script src="./js/lightDark_mood.js"></script>
  <script src="./js/burger-sidebar.js"></script>
  <script src="./js/mobile-search.js"></script>
  <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.all.min.js'></script>
</body>

</html>
