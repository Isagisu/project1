<?php
function calculateHeat($replies, $likes, $views, $favorites, $shares, $downvotes, $postTime) {
    // 權重設定
    $weightReplies = 5;    // 回覆的影響力
    $weightLikes = 3;      // 點讚的影響力
    $weightViews = 0.5;    // 瀏覽數的影響力
    $weightFavorites = 4;  // 收藏的影響力
    $weightShares = 6;     // 分享的影響力
    $weightDownvotes = -2; // 踩的影響力（負數）

    // 時間衰減因子（防止老貼文佔據熱門）
    $hoursSincePost = (time() - strtotime($postTime)) / 3600; // 轉換為小時
    $decayFactor = 1 / pow(($hoursSincePost + 2), 1.5); // 避免 0 運算錯誤

    // 計算熱度
    $heat = ($replies * $weightReplies) +
            ($likes * $weightLikes) +
            ($views * $weightViews) +
            ($favorites * $weightFavorites) +
            ($shares * $weightShares) +
            ($downvotes * $weightDownvotes);

    // 應用時間衰減
    $heat *= $decayFactor;

    return round($heat, 0); // 四捨五入保留兩位小數
}

// 測試範例
$replies = 20;
$likes = 50;
$views = 1000;
$favorites = 10;
$shares = 5;
$downvotes = 2;
$postTime = "2025-02-24 12:00:00"; // 貼文發佈時間

$heat = calculateHeat($replies, $likes, $views, $favorites, $shares, $downvotes, $postTime);
echo "計算出的熱度為: $heat";
?>
