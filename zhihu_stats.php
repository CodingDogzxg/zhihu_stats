<?php
    $userName = $_GET["username"];

    $url1 = "https://api.zhihu.com/people/$userName";
    $response1 = file_get_contents($url1);
    $result = json_decode($response1, true);
    
    
    $name = $result["name"];
    $follower = $result["follower_count"];
    $likes = $result["voteup_count"];
    $thanks = $result["thanked_count"];
    $collects = $result["favorited_count"];
    $articles = $result["articles_count"];
    $icon = $result["avatar_url"];
    
    
    header("Content-type: image/svg+xml; charset=utf-8");

    header("accept-ranges: bytes");
    
    echo <<<EOT
    <svg width="495" height="195" viewBox="0 0 495 195" fill="none" xmlns="http://www.w3.org/2000/svg">
        <style>
            .header {
                font: 550 20px 'Segoe UI', Ubuntu, Sans-Serif;
                fill: #2f80ed;
            }
            .stat {
                font: 600 14px 'Segoe UI', Ubuntu, "Helvetica Neue", Sans-Serif; fill: #333;
            }
            .bold { font-weight: 700 }
            .rank-circle-rim {
                stroke: #fffffe;
                fill: none;
                stroke-width: 36;
                opacity: 1;
            }
        </style>
        <rect xmlns="http://www.w3.org/2000/svg" x="0.5" y="0.5" rx="4.5" height="99%" stroke="#E4E2E2" width="494" fill="#fffefe" stroke-opacity="1"/>
        <g transform="translate(25, 35)">
            <text xmlns="http://www.w3.org/2000/svg" class="header" >{$name} 的知乎生涯</text>
        </g>
        
        
        <svg xmlns="http://www.w3.org/2000/svg" x="0" y="0">
            <g transform="translate(25, 55)">
                <g xmlns="http://www.w3.org/2000/svg" transform="translate(310, 0)">
                    <image href="{$icon}" height="100" width="100"/>
                    <circle xmlns="http://www.w3.org/2000/svg" class="rank-circle-rim" cx="50" cy="50" r="68"/>
                 </g>
            
                <g transform="translate(0, 0)">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="#646464" viewBox="0 0 24 24" width="16" height="16">
                        <path d="M14.445 9h5.387s2.997.154 1.95 3.669c-.168.51-2.346 6.911-2.346 6.911s-.763 1.416-2.86 1.416H8.989c-1.498 0-2.005-.896-1.989-2v-7.998c0-.987.336-2.032 1.114-2.639 4.45-3.773 3.436-4.597 4.45-5.83.985-1.13 3.2-.5 3.037 2.362C15.201 7.397 14.445 9 14.445 9zM3 9h2a1 1 0 0 1 1 1v10a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V10a1 1 0 0 1 1-1z" fill-rule="evenodd"/>
                    </svg>
                    <text class="stat bold" x="25" y="12.5">获得赞同:</text>
                    <text class="stat" x="170" y="12.5">{$likes}</text>
                </g>
                <g transform="translate(0, 25)">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="#646464" viewBox="3 2 19 21" width="16" height="16">
                        <path d="M2 8.437C2 5.505 4.294 3.094 7.207 3 9.243 3 11.092 4.19 12 6c.823-1.758 2.649-3 4.651-3C19.545 3 22 5.507 22 8.432 22 16.24 13.842 21 12 21 10.158 21 2 16.24 2 8.437z"/>
                    </svg>
                    <text class="stat bold" x="25" y="12.5">被喜欢:</text>
                    <text class="stat" x="170" y="12.5">{$thanks}</text>
                </g>
                <g transform="translate(0, 50)">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="#646464" viewBox="3 3 17 19" version="1.1" width="16" height="16">
                        <path d="M5.515 19.64l.918-5.355-3.89-3.792c-.926-.902-.639-1.784.64-1.97L8.56 7.74l2.404-4.871c.572-1.16 1.5-1.16 2.072 0L15.44 7.74l5.377.782c1.28.186 1.566 1.068.64 1.97l-3.89 3.793.918 5.354c.219 1.274-.532 1.82-1.676 1.218L12 18.33l-4.808 2.528c-1.145.602-1.896.056-1.677-1.218z" fill-rule="evenodd"/>
                    </svg>
                    <text class="stat bold" x="25" y="12.5">被收藏:</text>
                    <text class="stat" x="170" y="12.5">{$collects}</text>
                </g>
                <g transform="translate(0, 75)">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="#646464" viewBox="3 1 19 21" version="1.1" width="16" height="16">
                        <path d="M15.075 15.388l-3.024 3.024a4.041 4.041 0 0 0-1.014 1.697l-.26.868C7.844 20.986 4.91 21 2 21c.026-3.325 0-3.304.59-3.956 1.237-1.368 6.251-.68 6.44-2.976.043-.518-.36-1.06-.725-1.69C6.285 8.87 5.512 2 11.5 2c5.988 0 5.15 7.072 3.246 10.378-.357.62-.795 1.217-.724 1.77.073.571.477.958 1.053 1.24zm5.402 1.672c.523.55.523.646.523 3.94a535.11 535.11 0 0 0-4.434-.028l3.911-3.912zm-7.88 2.699c.111-.37.312-.705.584-.978l4.76-4.76a.291.291 0 0 1 .412 0l1.626 1.626a.291.291 0 0 1 0 .411l-4.76 4.76c-.272.273-.608.474-.978.585l-1.96.588a.219.219 0 0 1-.272-.272l.589-1.96zm9.157-6.742a.839.839 0 0 1 0 1.187l-.94.94a.28.28 0 0 1-.395 0l-1.563-1.563a.28.28 0 0 1 0-.395l.94-.94a.839.839 0 0 1 1.187 0l.771.771z" fill-rule="evenodd"></path>
                    </svg>
                    <text class="stat bold" x="25" y="12.5">粉丝数:</text>
                    <text class="stat" x="170" y="12.5">{$follower}</text>
                </g>
                <g transform="translate(0, 100)">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="#646464" viewBox="3 1 19 21" version="1.1" width="16" height="16">
                        <path d="M12 22C6.477 22 2 17.523 2 12S6.477 2 12 2s10 4.477 10 10-4.477 10-10 10zm4.043-15.524a.745.745 0 0 0-1.053.017l-6.857 7.071 2.237 2.17 6.857-7.071a.743.743 0 0 0-.016-1.052l-1.168-1.135zm-9.028 9.476l-.348 1.381 1.37-.39 1.274-.36-1.973-1.916-.323 1.285z" fill-rule="evenodd"></path>
                    </svg>
                    <text class="stat bold" x="25" y="12.5">文章数:</text>
                    <text class="stat" x="170" y="12.5">{$articles}</text>
                </g>
            </g>
        </svg>
        
    </svg>
    
EOT;

?>