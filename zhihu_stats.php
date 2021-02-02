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
    $weight = (50 - ($likes + $thanks + $collects) * 0.0001);
    
    if ($follower < 500){
        $level = "A-";
    }elseif ($follower > 500 && $follower < 1000){
        $level = "A+";
    }
    else {
        $level = "S";
    }
    
    header("Content-type: image/svg+xml; charset=utf-8");
    header("accept-ranges: bytes");
    header("Cache-Control : max-age=600");
    
    echo <<<EOT
    <svg width="495" height="160" viewBox="0 0 495 160" fill="none" xmlns="http://www.w3.org/2000/svg">
        <style>
            .header {
                font: 550 20px 'Segoe UI', Ubuntu, Sans-Serif;
                fill: #2f80ed;
            }
            .stat {
                font: 600 14px 'Segoe UI', Ubuntu, "Helvetica Neue", Sans-Serif; fill: #333;
            }
            .stagger {
                opacity: 0;
                animation: fadeInAnimation 0.3s ease-in-out forwards;
            }
            .rank-text {
                font: 800 24px 'Segoe UI', Ubuntu, Sans-Serif; fill: #333; 
                animation: scaleInAnimation 0.3s ease-in-out forwards;
            }
            .bold { font-weight: 700 }
            .rank-circle-rim {
                stroke: #2f80ed;
                fill: none;
                stroke-width: 6;
                opacity: 0.2;
            }
            .rank-circle {
                stroke: #2f80ed;
                stroke-dasharray: 250;
                fill: none;
                stroke-width: 6;
                stroke-linecap: round;
                opacity: 0.8;
                transform-origin: -10px 8px;
                transform: rotate(-90deg);
                animation: rankAnimation 1s forwards ease-in-out;
            }
            
            @keyframes rankAnimation {
                from {
                    stroke-dashoffset: 251.32741228718345;
                }
                to {
                    stroke-dashoffset: {$weight};
                }
            }
                  
            /* Animations */
            @keyframes scaleInAnimation {
                from {
                    transform: translate(-5px, 5px) scale(0);
                }
                to {
                    transform: translate(-5px, 5px) scale(1);
                }
            }
            @keyframes fadeInAnimation {
                from {
                    opacity: 0;
                }
                to {
                    opacity: 1;
                }
            }
        </style>
        <rect xmlns="http://www.w3.org/2000/svg" x="0.5" y="0.5" rx="4.5" height="99%" stroke="#E4E2E2" width="494" fill="#fffefe" stroke-opacity="1"/>
        <g transform="translate(25, 35)">
            <text xmlns="http://www.w3.org/2000/svg" class="header" >{$name} 的知乎生涯</text>
        </g>
        
        <g xmlns="http://www.w3.org/2000/svg" data-testid="rank-circle" transform="translate(400, 95)">
            <circle class="rank-circle-rim" cx="-10" cy="8" r="40"/>
            <circle class="rank-circle" cx="-10" cy="8" r="40"/>
            <g class="rank-text">
                <text x="-4" y="0" alignment-baseline="central" dominant-baseline="central" text-anchor="middle">{$level}</text>
            </g>
        </g>
        <svg xmlns="http://www.w3.org/2000/svg" x="0" y="0">
            <g transform="translate(25, 55)">
            
                <g class="stagger" style="animation-delay: 450ms" transform="translate(0, 0)">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="#646464" viewBox="0 0 24 24" width="16" height="16">
                        <path d="M14.445 9h5.387s2.997.154 1.95 3.669c-.168.51-2.346 6.911-2.346 6.911s-.763 1.416-2.86 1.416H8.989c-1.498 0-2.005-.896-1.989-2v-7.998c0-.987.336-2.032 1.114-2.639 4.45-3.773 3.436-4.597 4.45-5.83.985-1.13 3.2-.5 3.037 2.362C15.201 7.397 14.445 9 14.445 9zM3 9h2a1 1 0 0 1 1 1v10a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V10a1 1 0 0 1 1-1z" fill-rule="evenodd"/>
                    </svg>
                    <text class="stat bold" x="25" y="12.5">获得赞同:</text>
                    <text class="stat" x="170" y="12.5">{$likes}</text>
                </g>
                <g class="stagger" style="animation-delay: 600ms" transform="translate(0, 25)">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="#646464" viewBox="3 2 19 21" width="16" height="16">
                        <path d="M2 8.437C2 5.505 4.294 3.094 7.207 3 9.243 3 11.092 4.19 12 6c.823-1.758 2.649-3 4.651-3C19.545 3 22 5.507 22 8.432 22 16.24 13.842 21 12 21 10.158 21 2 16.24 2 8.437z"/>
                    </svg>
                    <text class="stat bold" x="25" y="12.5">被喜欢:</text>
                    <text class="stat" x="170" y="12.5">{$thanks}</text>
                </g>
                <g class="stagger" style="animation-delay: 750ms" transform="translate(0, 50)">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="#646464" viewBox="3 3 17 19" version="1.1" width="16" height="16">
                        <path d="M5.515 19.64l.918-5.355-3.89-3.792c-.926-.902-.639-1.784.64-1.97L8.56 7.74l2.404-4.871c.572-1.16 1.5-1.16 2.072 0L15.44 7.74l5.377.782c1.28.186 1.566 1.068.64 1.97l-3.89 3.793.918 5.354c.219 1.274-.532 1.82-1.676 1.218L12 18.33l-4.808 2.528c-1.145.602-1.896.056-1.677-1.218z" fill-rule="evenodd"/>
                    </svg>
                    <text class="stat bold" x="25" y="12.5">被收藏:</text>
                    <text class="stat" x="170" y="12.5">{$collects}</text>
                </g>
                <g class="stagger" style="animation-delay: 900ms" transform="translate(0, 75)">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="#646464" viewBox="3 1 19 21" version="1.1" width="16" height="16">
                        <path d="M15.075 15.388l-3.024 3.024a4.041 4.041 0 0 0-1.014 1.697l-.26.868C7.844 20.986 4.91 21 2 21c.026-3.325 0-3.304.59-3.956 1.237-1.368 6.251-.68 6.44-2.976.043-.518-.36-1.06-.725-1.69C6.285 8.87 5.512 2 11.5 2c5.988 0 5.15 7.072 3.246 10.378-.357.62-.795 1.217-.724 1.77.073.571.477.958 1.053 1.24zm5.402 1.672c.523.55.523.646.523 3.94a535.11 535.11 0 0 0-4.434-.028l3.911-3.912zm-7.88 2.699c.111-.37.312-.705.584-.978l4.76-4.76a.291.291 0 0 1 .412 0l1.626 1.626a.291.291 0 0 1 0 .411l-4.76 4.76c-.272.273-.608.474-.978.585l-1.96.588a.219.219 0 0 1-.272-.272l.589-1.96zm9.157-6.742a.839.839 0 0 1 0 1.187l-.94.94a.28.28 0 0 1-.395 0l-1.563-1.563a.28.28 0 0 1 0-.395l.94-.94a.839.839 0 0 1 1.187 0l.771.771z" fill-rule="evenodd"></path>
                    </svg>
                    <text class="stat bold" x="25" y="12.5">粉丝数:</text>
                    <text class="stat" x="170" y="12.5">{$follower}</text>
                </g>
            </g>
        </svg>
        
    </svg>
    
EOT;

?>