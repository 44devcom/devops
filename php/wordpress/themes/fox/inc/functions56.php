<?php
// extract int from string
function fox56_int( $x ) {
    $int_var = (int)filter_var($x, FILTER_SANITIZE_NUMBER_INT);
    return $int_var;
}

/**
 * abstract: new template function since Fox 5.6
 */

 function fox56_fa() {
    return ['fab fa-500px', 'fab fa-accessible-icon', 'fab fa-accusoft', 'fas fa-address-book', 'far fa-address-book', 'fas fa-address-card', 'far fa-address-card', 'fas fa-adjust', 'fab fa-adn', 'fab fa-adversal', 'fab fa-affiliatetheme', 'fab fa-algolia', 'fas fa-align-center', 'fas fa-align-justify', 'fas fa-align-left', 'fas fa-align-right', 'fas fa-allergies', 'fab fa-amazon', 'fab fa-amazon-pay', 'fas fa-ambulance', 'fas fa-american-sign-language-interpreting', 'fab fa-amilia', 'fas fa-anchor', 'fab fa-android', 'fab fa-angellist', 'fas fa-angle-double-down', 'fas fa-angle-double-left', 'fas fa-angle-double-right', 'fas fa-angle-double-up', 'fas fa-angle-down', 'fas fa-angle-left', 'fas fa-angle-right', 'fas fa-angle-up', 'fab fa-angrycreative', 'fab fa-angular', 'fab fa-app-store', 'fab fa-app-store-ios', 'fab fa-apper', 'fab fa-apple', 'fab fa-apple-pay', 'fas fa-archive', 'fas fa-arrow-alt-circle-down', 'far fa-arrow-alt-circle-down', 'fas fa-arrow-alt-circle-left', 'far fa-arrow-alt-circle-left', 'fas fa-arrow-alt-circle-right', 'far fa-arrow-alt-circle-right', 'fas fa-arrow-alt-circle-up', 'far fa-arrow-alt-circle-up', 'fas fa-arrow-circle-down', 'fas fa-arrow-circle-left', 'fas fa-arrow-circle-right', 'fas fa-arrow-circle-up', 'fas fa-arrow-down', 'fas fa-arrow-left', 'fas fa-arrow-right', 'fas fa-arrow-up', 'fas fa-arrows-alt', 'fas fa-arrows-alt-h', 'fas fa-arrows-alt-v', 'fas fa-assistive-listening-systems', 'fas fa-asterisk', 'fab fa-asymmetrik', 'fas fa-at', 'fab fa-audible', 'fas fa-audio-description', 'fab fa-autoprefixer', 'fab fa-avianex', 'fab fa-aviato', 'fab fa-aws', 'fas fa-backward', 'fas fa-balance-scale', 'fas fa-ban', 'fas fa-band-aid', 'fab fa-bandcamp', 'fas fa-barcode', 'fas fa-bars', 'fas fa-baseball-ball', 'fas fa-basketball-ball', 'fas fa-bath', 'fas fa-battery-empty', 'fas fa-battery-full', 'fas fa-battery-half', 'fas fa-battery-quarter', 'fas fa-battery-three-quarters', 'fas fa-bed', 'fas fa-beer', 'fab fa-behance', 'fab fa-behance-square', 'fas fa-bell', 'far fa-bell', 'fas fa-bell-slash', 'far fa-bell-slash', 'fas fa-bicycle', 'fab fa-bimobject', 'fas fa-binoculars', 'fas fa-birthday-cake', 'fab fa-bitbucket', 'fab fa-bitcoin', 'fab fa-bity', 'fab fa-black-tie', 'fab fa-blackberry', 'fas fa-blind', 'fab fa-blogger', 'fab fa-blogger-b', 'fab fa-bluetooth', 'fab fa-bluetooth-b', 'fas fa-bold', 'fas fa-bolt', 'fas fa-bomb', 'fas fa-book', 'fas fa-bookmark', 'far fa-bookmark', 'fas fa-bowling-ball', 'fas fa-box', 'fas fa-box-open', 'fas fa-boxes', 'fas fa-braille', 'fas fa-briefcase', 'fas fa-briefcase-medical', 'fab fa-btc', 'fas fa-bug', 'fas fa-building', 'far fa-building', 'fas fa-bullhorn', 'fas fa-bullseye', 'fas fa-burn', 'fab fa-buromobelexperte', 'fas fa-bus', 'fab fa-buysellads', 'fas fa-calculator', 'fas fa-calendar', 'far fa-calendar', 'fas fa-calendar-alt', 'far fa-calendar-alt', 'fas fa-calendar-check', 'far fa-calendar-check', 'fas fa-calendar-minus', 'far fa-calendar-minus', 'fas fa-calendar-plus', 'far fa-calendar-plus', 'fas fa-calendar-times', 'far fa-calendar-times', 'fas fa-camera', 'fas fa-camera-retro', 'fas fa-capsules', 'fas fa-car', 'fas fa-caret-down', 'fas fa-caret-left', 'fas fa-caret-right', 'fas fa-caret-square-down', 'far fa-caret-square-down', 'fas fa-caret-square-left', 'far fa-caret-square-left', 'fas fa-caret-square-right', 'far fa-caret-square-right', 'fas fa-caret-square-up', 'far fa-caret-square-up', 'fas fa-caret-up', 'fas fa-cart-arrow-down', 'fas fa-cart-plus', 'fab fa-cc-amazon-pay', 'fab fa-cc-amex', 'fab fa-cc-apple-pay', 'fab fa-cc-diners-club', 'fab fa-cc-discover', 'fab fa-cc-jcb', 'fab fa-cc-mastercard', 'fab fa-cc-paypal', 'fab fa-cc-stripe', 'fab fa-cc-visa', 'fab fa-centercode', 'fas fa-certificate', 'fas fa-chart-area', 'fas fa-chart-bar', 'far fa-chart-bar', 'fas fa-chart-line', 'fas fa-chart-pie', 'fas fa-check', 'fas fa-check-circle', 'far fa-check-circle', 'fas fa-check-square', 'far fa-check-square', 'fas fa-chess', 'fas fa-chess-bishop', 'fas fa-chess-board', 'fas fa-chess-king', 'fas fa-chess-knight', 'fas fa-chess-pawn', 'fas fa-chess-queen', 'fas fa-chess-rook', 'fas fa-chevron-circle-down', 'fas fa-chevron-circle-left', 'fas fa-chevron-circle-right', 'fas fa-chevron-circle-up', 'fas fa-chevron-down', 'fas fa-chevron-left', 'fas fa-chevron-right', 'fas fa-chevron-up', 'fas fa-child', 'fab fa-chrome', 'fas fa-circle', 'far fa-circle', 'fas fa-circle-notch', 'fas fa-clipboard', 'far fa-clipboard', 'fas fa-clipboard-check', 'fas fa-clipboard-list', 'fas fa-clock', 'far fa-clock', 'fas fa-clone', 'far fa-clone', 'fas fa-closed-captioning', 'far fa-closed-captioning', 'fas fa-cloud', 'fas fa-cloud-download-alt', 'fas fa-cloud-upload-alt', 'fab fa-cloudscale', 'fab fa-cloudsmith', 'fab fa-cloudversify', 'fas fa-code', 'fas fa-code-branch', 'fab fa-codepen', 'fab fa-codiepie', 'fas fa-coffee', 'fas fa-cog', 'fas fa-cogs', 'fas fa-columns', 'fas fa-comment', 'far fa-comment', 'fas fa-comment-alt', 'far fa-comment-alt', 'fas fa-comment-dots', 'fas fa-comment-slash', 'fas fa-comments', 'far fa-comments', 'fas fa-compass', 'far fa-compass', 'fas fa-compress', 'fab fa-connectdevelop', 'fab fa-contao', 'fas fa-copy', 'far fa-copy', 'fas fa-copyright', 'far fa-copyright', 'fas fa-couch', 'fab fa-cpanel', 'fab fa-creative-commons', 'fas fa-credit-card', 'far fa-credit-card', 'fas fa-crop', 'fas fa-crosshairs', 'fab fa-css3', 'fab fa-css3-alt', 'fas fa-cube', 'fas fa-cubes', 'fas fa-cut', 'fab fa-cuttlefish', 'fab fa-d-and-d', 'fab fa-dashcube', 'fas fa-database', 'fas fa-deaf', 'fab fa-delicious', 'fab fa-deploydog', 'fab fa-deskpro', 'fas fa-desktop', 'fab fa-deviantart', 'fas fa-diagnoses', 'fab fa-digg', 'fab fa-digital-ocean', 'fab fa-discord', 'fab fa-discourse', 'fas fa-dna', 'fab fa-dochub', 'fab fa-docker', 'fas fa-dollar-sign', 'fas fa-dolly', 'fas fa-dolly-flatbed', 'fas fa-donate', 'fas fa-dot-circle', 'far fa-dot-circle', 'fas fa-dove', 'fas fa-download', 'fab fa-draft2digital', 'fab fa-dribbble', 'fab fa-dribbble-square', 'fab fa-dropbox', 'fab fa-drupal', 'fab fa-dyalog', 'fab fa-earlybirds', 'fab fa-edge', 'fas fa-edit', 'far fa-edit', 'fas fa-eject', 'fab fa-elementor', 'fas fa-ellipsis-h', 'fas fa-ellipsis-v', 'fab fa-ember', 'fab fa-empire', 'fas fa-envelope', 'far fa-envelope', 'fas fa-envelope-open', 'far fa-envelope-open', 'fas fa-envelope-square', 'fab fa-envira', 'fas fa-eraser', 'fab fa-erlang', 'fab fa-ethereum', 'fab fa-etsy', 'fas fa-euro-sign', 'fas fa-exchange-alt', 'fas fa-exclamation', 'fas fa-exclamation-circle', 'fas fa-exclamation-triangle', 'fas fa-expand', 'fas fa-expand-arrows-alt', 'fab fa-expeditedssl', 'fas fa-external-link-alt', 'fas fa-external-link-square-alt', 'fas fa-eye', 'fas fa-eye-dropper', 'fas fa-eye-slash', 'far fa-eye-slash', 'fab fa-facebook', 'fab fa-facebook-f', 'fab fa-facebook-messenger', 'fab fa-facebook-square', 'fas fa-fast-backward', 'fas fa-fast-forward', 'fas fa-fax', 'fas fa-female', 'fas fa-fighter-jet', 'fas fa-file', 'far fa-file', 'fas fa-file-alt', 'far fa-file-alt', 'fas fa-file-archive', 'far fa-file-archive', 'fas fa-file-audio', 'far fa-file-audio', 'fas fa-file-code', 'far fa-file-code', 'fas fa-file-excel', 'far fa-file-excel', 'fas fa-file-image', 'far fa-file-image', 'fas fa-file-medical', 'fas fa-file-medical-alt', 'fas fa-file-pdf', 'far fa-file-pdf', 'fas fa-file-powerpoint', 'far fa-file-powerpoint', 'fas fa-file-video', 'far fa-file-video', 'fas fa-file-word', 'far fa-file-word', 'fas fa-film', 'fas fa-filter', 'fas fa-fire', 'fas fa-fire-extinguisher', 'fab fa-firefox', 'fas fa-first-aid', 'fab fa-first-order', 'fab fa-firstdraft', 'fas fa-flag', 'far fa-flag', 'fas fa-flag-checkered', 'fas fa-flask', 'fab fa-flickr', 'fab fa-flipboard', 'fab fa-fly', 'fas fa-folder', 'far fa-folder', 'fas fa-folder-open', 'far fa-folder-open', 'fas fa-font', 'fab fa-font-awesome', 'fab fa-font-awesome-alt', 'fab fa-font-awesome-flag', 'fab fa-fonticons', 'fab fa-fonticons-fi', 'fas fa-football-ball', 'fab fa-fort-awesome', 'fab fa-fort-awesome-alt', 'fab fa-forumbee', 'fas fa-forward', 'fab fa-foursquare', 'fab fa-free-code-camp', 'fab fa-freebsd', 'fas fa-frown', 'far fa-frown', 'fas fa-futbol', 'far fa-futbol', 'fas fa-gamepad', 'fas fa-gavel', 'fas fa-gem', 'far fa-gem', 'fas fa-genderless', 'fab fa-get-pocket', 'fab fa-gg', 'fab fa-gg-circle', 'fas fa-gift', 'fab fa-git', 'fab fa-git-square', 'fab fa-github', 'fab fa-github-alt', 'fab fa-github-square', 'fab fa-gitkraken', 'fab fa-gitlab', 'fab fa-gitter', 'fas fa-glass-martini', 'fab fa-glide', 'fab fa-glide-g', 'fas fa-globe', 'fab fa-gofore', 'fas fa-golf-ball', 'fab fa-goodreads', 'fab fa-goodreads-g', 'fab fa-google', 'fab fa-google-drive', 'fab fa-google-play', 'fab fa-google-plus', 'fab fa-google-plus-g', 'fab fa-google-plus-square', 'fab fa-google-wallet', 'fas fa-graduation-cap', 'fab fa-gratipay', 'fab fa-grav', 'fab fa-gripfire', 'fab fa-grunt', 'fab fa-gulp', 'fas fa-h-square', 'fab fa-hacker-news', 'fab fa-hacker-news-square', 'fas fa-hand-holding', 'fas fa-hand-holding-heart', 'fas fa-hand-holding-usd', 'fas fa-hand-lizard', 'far fa-hand-lizard', 'fas fa-hand-paper', 'far fa-hand-paper', 'fas fa-hand-peace', 'far fa-hand-peace', 'fas fa-hand-point-down', 'far fa-hand-point-down', 'fas fa-hand-point-left', 'far fa-hand-point-left', 'fas fa-hand-point-right', 'far fa-hand-point-right', 'fas fa-hand-point-up', 'far fa-hand-point-up', 'fas fa-hand-pointer', 'far fa-hand-pointer', 'fas fa-hand-rock', 'far fa-hand-rock', 'fas fa-hand-scissors', 'far fa-hand-scissors', 'fas fa-hand-spock', 'far fa-hand-spock', 'fas fa-hands', 'fas fa-hands-helping', 'fas fa-handshake', 'far fa-handshake', 'fas fa-hashtag', 'fas fa-hdd', 'far fa-hdd', 'fas fa-heading', 'fas fa-headphones', 'fas fa-heart', 'far fa-heart', 'fas fa-heartbeat', 'fab fa-hips', 'fab fa-hire-a-helper', 'fas fa-history', 'fas fa-hockey-puck', 'fas fa-home', 'fab fa-hooli', 'fas fa-hospital', 'far fa-hospital', 'fas fa-hospital-alt', 'fas fa-hospital-symbol', 'fab fa-hotjar', 'fas fa-hourglass', 'far fa-hourglass', 'fas fa-hourglass-end', 'fas fa-hourglass-half', 'fas fa-hourglass-start', 'fab fa-houzz', 'fab fa-html5', 'fab fa-hubspot', 'fas fa-i-cursor', 'fas fa-id-badge', 'far fa-id-badge', 'fas fa-id-card', 'far fa-id-card', 'fas fa-id-card-alt', 'fas fa-image', 'far fa-image', 'fas fa-images', 'far fa-images', 'fab fa-imdb', 'fas fa-inbox', 'fas fa-indent', 'fas fa-industry', 'fas fa-info', 'fas fa-info-circle', 'fab fa-instagram', 'fab fa-internet-explorer', 'fab fa-ioxhost', 'fas fa-italic', 'fab fa-itunes', 'fab fa-itunes-note', 'fab fa-java', 'fab fa-jenkins', 'fab fa-joget', 'fab fa-joomla', 'fab fa-js', 'fab fa-js-square', 'fab fa-jsfiddle', 'fas fa-key', 'fas fa-keyboard', 'far fa-keyboard', 'fab fa-keycdn', 'fab fa-kickstarter', 'fab fa-kickstarter-k', 'fab fa-korvue', 'fas fa-language', 'fas fa-laptop', 'fab fa-laravel', 'fab fa-lastfm', 'fab fa-lastfm-square', 'fas fa-leaf', 'fab fa-leanpub', 'fas fa-lemon', 'far fa-lemon', 'fab fa-less', 'fas fa-level-down-alt', 'fas fa-level-up-alt', 'fas fa-life-ring', 'far fa-life-ring', 'fas fa-lightbulb', 'far fa-lightbulb', 'fab fa-line', 'fas fa-link', 'fab fa-linkedin', 'fab fa-linkedin-in', 'fab fa-linode', 'fab fa-linux', 'fas fa-lira-sign', 'fas fa-list', 'fas fa-list-alt', 'far fa-list-alt', 'fas fa-list-ol', 'fas fa-list-ul', 'fas fa-location-arrow', 'fas fa-lock', 'fas fa-lock-open', 'fas fa-long-arrow-alt-down', 'fas fa-long-arrow-alt-left', 'fas fa-long-arrow-alt-right', 'fas fa-long-arrow-alt-up', 'fas fa-low-vision', 'fab fa-lyft', 'fab fa-magento', 'fas fa-magic', 'fas fa-magnet', 'fas fa-male', 'fas fa-map', 'far fa-map', 'fas fa-map-marker', 'fas fa-map-marker-alt', 'fas fa-map-pin', 'fas fa-map-signs', 'fas fa-mars', 'fas fa-mars-double', 'fas fa-mars-stroke', 'fas fa-mars-stroke-h', 'fas fa-mars-stroke-v', 'fab fa-maxcdn', 'fab fa-medapps', 'fab fa-medium', 'fab fa-medium-m', 'fas fa-medkit', 'fab fa-medrt', 'fab fa-meetup', 'fas fa-meh', 'far fa-meh', 'fas fa-mercury', 'fas fa-microchip', 'fas fa-microphone', 'fas fa-microphone-slash', 'fab fa-microsoft', 'fas fa-minus', 'fas fa-minus-circle', 'fas fa-minus-square', 'far fa-minus-square', 'fab fa-mix', 'fab fa-mixcloud', 'fab fa-mizuni', 'fas fa-mobile', 'fas fa-mobile-alt', 'fab fa-modx', 'fab fa-monero', 'fas fa-money-bill-alt', 'far fa-money-bill-alt', 'fas fa-moon', 'far fa-moon', 'fas fa-motorcycle', 'fas fa-mouse-pointer', 'fas fa-music', 'fab fa-napster', 'fas fa-neuter', 'fas fa-newspaper', 'far fa-newspaper', 'fab fa-nintendo-switch', 'fab fa-node', 'fab fa-node-js', 'fas fa-notes-medical', 'fab fa-npm', 'fab fa-ns8', 'fab fa-nutritionix', 'fas fa-object-group', 'far fa-object-group', 'fas fa-object-ungroup', 'far fa-object-ungroup', 'fab fa-odnoklassniki', 'fab fa-odnoklassniki-square', 'fab fa-opencart', 'fab fa-openid', 'fab fa-opera', 'fab fa-optin-monster', 'fab fa-osi', 'fas fa-outdent', 'fab fa-page4', 'fab fa-pagelines', 'fas fa-paint-brush', 'fab fa-palfed', 'fas fa-pallet', 'fas fa-paper-plane', 'far fa-paper-plane', 'fas fa-paperclip', 'fas fa-parachute-box', 'fas fa-paragraph', 'fas fa-paste', 'fab fa-patreon', 'fas fa-pause', 'fas fa-pause-circle', 'far fa-pause-circle', 'fas fa-paw', 'fab fa-paypal', 'fas fa-pen-square', 'fas fa-pencil-alt', 'fas fa-people-carry', 'fas fa-percent', 'fab fa-periscope', 'fab fa-phabricator', 'fab fa-phoenix-framework', 'fas fa-phone', 'fas fa-phone-slash', 'fas fa-phone-square', 'fas fa-phone-volume', 'fab fa-php', 'fab fa-pied-piper', 'fab fa-pied-piper-alt', 'fab fa-pied-piper-hat', 'fab fa-pied-piper-pp', 'fas fa-piggy-bank', 'fas fa-pills', 'fab fa-pinterest', 'fab fa-pinterest-p', 'fab fa-pinterest-square', 'fas fa-plane', 'fas fa-play', 'fas fa-play-circle', 'far fa-play-circle', 'fab fa-playstation', 'fas fa-plug', 'fas fa-plus', 'fas fa-plus-circle', 'fas fa-plus-square', 'far fa-plus-square', 'fas fa-podcast', 'fas fa-poo', 'fas fa-pound-sign', 'fas fa-power-off', 'fas fa-prescription-bottle', 'fas fa-prescription-bottle-alt', 'fas fa-print', 'fas fa-procedures', 'fab fa-product-hunt', 'fab fa-pushed', 'fas fa-puzzle-piece', 'fab fa-python', 'fab fa-qq', 'fas fa-qrcode', 'fas fa-question', 'fas fa-question-circle', 'far fa-question-circle', 'fas fa-quidditch', 'fab fa-quinscape', 'fab fa-quora', 'fas fa-quote-left', 'fas fa-quote-right', 'fas fa-random', 'fab fa-ravelry', 'fab fa-react', 'fab fa-readme', 'fab fa-rebel', 'fas fa-recycle', 'fab fa-red-river', 'fab fa-reddit', 'fab fa-reddit-alien', 'fab fa-reddit-square', 'fas fa-redo', 'fas fa-redo-alt', 'fas fa-registered', 'far fa-registered', 'fab fa-rendact', 'fab fa-renren', 'fas fa-reply', 'fas fa-reply-all', 'fab fa-replyd', 'fab fa-resolving', 'fas fa-retweet', 'fas fa-ribbon', 'fas fa-road', 'fas fa-rocket', 'fab fa-rocketchat', 'fab fa-rockrms', 'fas fa-rss', 'fas fa-rss-square', 'fas fa-ruble-sign', 'fas fa-rupee-sign', 'fab fa-safari', 'fab fa-sass', 'fas fa-save', 'far fa-save', 'fab fa-schlix', 'fab fa-scribd', 'fas fa-search', 'fas fa-search-minus', 'fas fa-search-plus', 'fab fa-searchengin', 'fas fa-seedling', 'fab fa-sellcast', 'fab fa-sellsy', 'fas fa-server', 'fab fa-servicestack', 'fas fa-share', 'fas fa-share-alt', 'fas fa-share-alt-square', 'fas fa-share-square', 'far fa-share-square', 'fas fa-shekel-sign', 'fas fa-shield-alt', 'fas fa-ship', 'fas fa-shipping-fast', 'fab fa-shirtsinbulk', 'fas fa-shopping-bag', 'fas fa-shopping-basket', 'fas fa-shopping-cart', 'fas fa-shower', 'fas fa-sign', 'fas fa-sign-in-alt', 'fas fa-sign-language', 'fas fa-sign-out-alt', 'fas fa-signal', 'fab fa-simplybuilt', 'fab fa-sistrix', 'fas fa-sitemap', 'fab fa-skyatlas', 'fab fa-skype', 'fab fa-slack', 'fab fa-slack-hash', 'fas fa-sliders-h', 'fab fa-slideshare', 'fas fa-smile', 'far fa-smile', 'fas fa-smoking', 'fab fa-snapchat', 'fab fa-snapchat-ghost', 'fab fa-snapchat-square', 'fas fa-snowflake', 'far fa-snowflake', 'fas fa-sort', 'fas fa-sort-alpha-down', 'fas fa-sort-alpha-up', 'fas fa-sort-amount-down', 'fas fa-sort-amount-up', 'fas fa-sort-down', 'fas fa-sort-numeric-down', 'fas fa-sort-numeric-up', 'fas fa-sort-up', 'fab fa-soundcloud', 'fas fa-space-shuttle', 'fab fa-speakap', 'fas fa-spinner', 'fab fa-spotify', 'fas fa-square', 'far fa-square', 'fas fa-square-full', 'fab fa-stack-exchange', 'fab fa-stack-overflow', 'fas fa-star', 'far fa-star', 'fas fa-star-half', 'far fa-star-half', 'fab fa-staylinked', 'fab fa-steam', 'fab fa-steam-square', 'fab fa-steam-symbol', 'fas fa-step-backward', 'fas fa-step-forward', 'fas fa-stethoscope', 'fab fa-sticker-mule', 'fas fa-sticky-note', 'far fa-sticky-note', 'fas fa-stop', 'fas fa-stop-circle', 'far fa-stop-circle', 'fas fa-stopwatch', 'fab fa-strava', 'fas fa-street-view', 'fas fa-strikethrough', 'fab fa-stripe', 'fab fa-stripe-s', 'fab fa-studiovinari', 'fab fa-stumbleupon', 'fab fa-stumbleupon-circle', 'fas fa-subscript', 'fas fa-subway', 'fas fa-suitcase', 'fas fa-sun', 'far fa-sun', 'fab fa-superpowers', 'fas fa-superscript', 'fab fa-supple', 'fas fa-sync', 'fas fa-sync-alt', 'fas fa-syringe', 'fas fa-table', 'fas fa-table-tennis', 'fas fa-tablet', 'fas fa-tablet-alt', 'fas fa-tablets', 'fas fa-tachometer-alt', 'fas fa-tag', 'fas fa-tags', 'fas fa-tape', 'fas fa-tasks', 'fas fa-taxi', 'fab fa-telegram', 'fab fa-telegram-plane', 'fab fa-tencent-weibo', 'fas fa-terminal', 'fas fa-text-height', 'fas fa-text-width', 'fas fa-th', 'fas fa-th-large', 'fas fa-th-list', 'fab fa-themeisle', 'fas fa-thermometer', 'fas fa-thermometer-empty', 'fas fa-thermometer-full', 'fas fa-thermometer-half', 'fas fa-thermometer-quarter', 'fas fa-thermometer-three-quarters', 'fas fa-thumbs-down', 'far fa-thumbs-down', 'fas fa-thumbs-up', 'far fa-thumbs-up', 'fas fa-thumbtack', 'fas fa-ticket-alt', 'fas fa-times', 'fas fa-times-circle', 'far fa-times-circle', 'fas fa-tint', 'fas fa-toggle-off', 'fas fa-toggle-on', 'fas fa-trademark', 'fas fa-train', 'fas fa-transgender', 'fas fa-transgender-alt', 'fas fa-trash', 'fas fa-trash-alt', 'far fa-trash-alt', 'fas fa-tree', 'fab fa-trello', 'fab fa-tripadvisor', 'fas fa-trophy', 'fas fa-truck', 'fas fa-truck-loading', 'fas fa-truck-moving', 'fas fa-tty', 'fab fa-tumblr', 'fab fa-tumblr-square', 'fas fa-tv', 'fab fa-twitch', 'fab fa-twitter', 'fab fa-twitter-square', 'fab fa-typo3', 'fab fa-uber', 'fab fa-uikit', 'fas fa-umbrella', 'fas fa-underline', 'fas fa-undo', 'fas fa-undo-alt', 'fab fa-uniregistry', 'fas fa-universal-access', 'fas fa-university', 'fas fa-unlink', 'fas fa-unlock', 'fas fa-unlock-alt', 'fab fa-untappd', 'fas fa-upload', 'fab fa-usb', 'fas fa-user', 'far fa-user', 'fas fa-user-circle', 'far fa-user-circle', 'fas fa-user-md', 'fas fa-user-plus', 'fas fa-user-secret', 'fas fa-user-times', 'fas fa-users', 'fab fa-ussunnah', 'fas fa-utensil-spoon', 'fas fa-utensils', 'fab fa-vaadin', 'fas fa-venus', 'fas fa-venus-double', 'fas fa-venus-mars', 'fab fa-viacoin', 'fab fa-viadeo', 'fab fa-viadeo-square', 'fas fa-vial', 'fas fa-vials', 'fab fa-viber', 'fas fa-video', 'fas fa-video-slash', 'fab fa-vimeo', 'fab fa-vimeo-square', 'fab fa-vimeo-v', 'fab fa-vine', 'fab fa-vk', 'fab fa-vnv', 'fas fa-volleyball-ball', 'fas fa-volume-down', 'fas fa-volume-off', 'fas fa-volume-up', 'fab fa-vuejs', 'fas fa-warehouse', 'fab fa-weibo', 'fas fa-weight', 'fab fa-weixin', 'fab fa-whatsapp', 'fab fa-whatsapp-square', 'fas fa-wheelchair', 'fab fa-whmcs', 'fas fa-wifi', 'fab fa-wikipedia-w', 'fas fa-window-close', 'far fa-window-close', 'fas fa-window-maximize', 'far fa-window-maximize', 'fas fa-window-minimize', 'far fa-window-minimize', 'fas fa-window-restore', 'far fa-window-restore', 'fab fa-windows', 'fas fa-wine-glass', 'fas fa-won-sign', 'fab fa-wordpress', 'fab fa-wordpress-simple', 'fab fa-wpbeginner', 'fab fa-wpexplorer', 'fab fa-wpforms', 'fas fa-wrench', 'fas fa-x-ray', 'fab fa-xbox', 'fab fa-xing', 'fab fa-xing-square', 'fab fa-y-combinator', 'fab fa-yahoo', 'fab fa-yandex', 'fab fa-yandex-international', 'fab fa-yelp', 'fas fa-yen-sign', 'fab fa-yoast', 'fab fa-youtube', 'fab fa-youtube-square' ];
}

function fox56_social_array() {
    $dt = [
        'facebook' => 'facebook|Facebook',
        'twitter' => 'twitter|Twitter',
        'x' => 'x-twitter|X',
        'instagram' => 'instagram|Instagram',
        'mastodon' => 'mastodon|Mastodon',
        'tiktok' => 'tiktok|Tiktok',
        'threads' => 'threads|Threads',
        'pinterest' => 'pinterest|Pinterest',
        'linkedin' => 'linkedin2|Linkedin',
        'youtube' => 'youtube|Youtube',
        'medium' => 'medium|Medium',
        'reddit' => 'reddit|Reddit',
        'snapchat' => 'snapchat|Snapchat',
        'whatsapp' => 'whatsapp|Whatsapp',
        'soundcloud' => 'soundcloud|Soundcloud',
        'spotify' => 'spotify|Spotify',
        'tumblr' => 'tumblr|Tumblr',
        'yelp' => 'yelp|Yelp',
        'vimeo' => 'vimeo|Vimeo',
        'telegram' => 'telegram|Telegram',
        'vk' => 'vk|VKontakte',
        'twitch' => 'twitch|Twitch',
        'tripadvisor' => 'tripadvisor|Tripadvisor',
        'behance' => 'behance|Behance',
        'dribbble' => 'dribbble|Dribbble',
        'flickr' => 'flickr|Flickr',
        'github' => 'github|Github',
        'paypal' => 'paypal|Paypal',
        'quora' => 'quora|Quora',
        'rss' => 'rss|RSS',
        'skype' => 'skype|Skype',
        'steam' => 'steam|Steam',
        'wordpress' => 'wordpress|WordPress',
        'yahoo' => 'yahoo|Yahoo!',
        'amazon' => 'amazon|Amazon',
        '500px' => '500px|500px',
        'weibo' => 'sina-weibo|Weibo',
        'email' => 'envelope|Email',
        'google' => 'google|Google',
    ];
    return apply_filters( 'fox_social_data', $dt );
    
}

 /**
 * general functions since Fox v5.6
 * RETURN, not echo
 * -------------------------------------------------------------------------------- */
function fox56_social_list( $args = [] ) {
    $items = get_theme_mod( 'social', [
        'facebook' => 'https://facebook.com/withemes/',
        'twitter' => 'https://twitter.com/withemes/',
        'instagram' => 'https://instagram.com/iamwithemes/'
    ] );
    if ( ! is_array($items)) {
        $items = explode( ',', strval( $items ) );
    }
    if ( empty( $items ) || ! is_array( $items ) ) {
        return;
    }
    $tooltip_position = isset( $args['tooltip_position'] ) ? $args['tooltip_position'] : 'top';
    $social_arr = fox56_social_array();
    $ul = [];
    foreach ( $items as $item => $url ) {
        $url = trim( strval( $url ) );
        if ( ! $url ) {
            continue;
        }
        $icon_info = isset( $social_arr[ $item ] ) ? $social_arr[ $item ] : '';
        $explode = explode( '|', $icon_info );
        if ( 2 == count( $explode ) ) { 
            $icon_cl = 'ic56-' . $explode[0];
            $icon_name = $explode[1];
        } else {
            continue;
        }
        $cl = [ 'social__item', 'item--' . $item ];
        
        if ( 'email' == $item ) {
            if ( ! strpos( $url, 'mailto:' ) ) {
                $url = 'mailto:' . $url;
            }
        }
        $icon_html = '<i class="' . esc_attr( $icon_cl ) . '"></i>';
        $cl[] = 'ic-icon';
        if ( $icon_name ) {
            $tooltip_attr = ' role="tooltip" aria-label="' . esc_attr( $icon_name ). '" data-microtip-position="' . esc_attr( $tooltip_position ). '"';
        } else {
            $tooltip_attr = '';
        }
        
        $li = '<li class="' . esc_attr( join( ' ', $cl )). '"><a href="' . esc_url( $url  ). '" target="_blank"' . $tooltip_attr . '>' . $icon_html . '</a></li>';
        $ul[] = $li;
    }
    $ul = join( "\n", $ul );
    $ul = '<ul>' . $ul . '</ul>';
    return $ul;
}

/**
 * cached menu
 * -------------------------------------------------------------------------------- */
function fox56_cached_menu( $location = 'primary', $depth = 0 ) {
    
    $cache = wp_cache_get( $location, 'menu' );
    if ( $cache && false ) {
        return $cache;
    } else {
        ob_start();
        
        wp_nav_menu([
            'theme_location'	=>	$location,
            'depth'				=>	$depth,
            'container_class'	=>	'menu',

            'link_before'   => '<span>',
            'link_after'    => '</span><u class="mk"></u>',
        ]);
        
        $cache = ob_get_clean();
        wp_cache_set( $location, $cache, 'menu' );
        
        return $cache;
        
    }
    
}

/**
 * image_html from image_url
 * we'll use transient to store the value
 * -------------------------------------------------------------------------------- */
function fox56_image_from_url( $image_url, $size = 'full', $args = [] ) {
    
    $key = 'fox-' . $image_url . '-' . $size;
    // delete_transient( $key);
    $img_html = get_transient( $key );
    if ( $img_html ) {
        return $img_html;
    }
    $img_id = attachment_url_to_postid( $image_url );
    if ( $img_id ) {
        $img_html = wp_get_attachment_image( $img_id, $size, false, $args );
        if ( $img_html ) {
            set_transient( $key, $img_html, WEEK_IN_SECONDS );
            return $img_html;
        }
    }
        
}

function fox56_link_target_attr() {
    if ( 'link' !== get_post_format() ) {
        return '';
    }
    $target_attr = '';
    $target = get_post_meta( get_the_ID(), '_format_link_target', true );
    if ( ! $target ) {
        $target = get_theme_mod( 'single_format_link_target', '_self' );
    }
    if ( '_blank' == $target ) {
        $target_attr = ' target="' . esc_attr( $target ) . '"';
    }

    return $target_attr;
}

/**
 * must be used inside loop
 */ 
function fox56_thumbnail( $args = [] ) {

    // early return, when we have thumbnail_html being set
    if ( isset( $args['thumbnail_html'])) {
        echo $args['thumbnail_html'];
        return;
    }

    $thumbnail_img_id = false;
    $postid = get_the_ID();
    $custom_thumbnail = get_post_meta( $postid, '_wi_blog_thumbnail', true );
    if ( $custom_thumbnail ) {
        $thumbnail_img_id = $custom_thumbnail;
    }
    if ( ! $thumbnail_img_id ) {
        $thumbnail_img_id = get_post_thumbnail_id();
    }
    if ( ! $thumbnail_img_id ) {
        $thumbnail_img_id = get_theme_mod( 'placeholder_thumbnail' );
    }

    if ( ! $thumbnail_img_id ) {
        return;
    }
    
    extract( wp_parse_args( $args,[
        'thumbnail_loading' => 'lazy',
        'thumbnail' => 'thumbnail-medium',
        'thumbnail_custom' => [ 'width' => 480, 'height' => 320 ],
        'thumbnail_rich' => false,
        'thumbnail_caption' => false,
        'thumbnail_hover_effect' => '',
        'thumbnail_hover_logo' => 0,
        'thumbnail_class' => '', // extra classes

        'thumbnail_format_indicator' => false,
        'thumbnail_review' => false,
        'thumbnail_view' => false,
        'thumbnail_index' => false,

        'thumbnail_showing_effect' => '',
    ]) );

    $cl = [ 'thumbnail56', 'component56' ];
    
    $inner_html = '';
    $img_html = '';

    $attrs = [];
    if ( 'eager' == $thumbnail_loading ) {
        $attrs[ 'loading' ] = 'eager';
    }

    if ( $thumbnail_rich ) {
        ob_start();
        $format = get_post_format();
        if ( 'video' == $format ) {
            fox56_single_video();
        } elseif ('audio' == $format ) {
            fox56_single_audio();
        }
        $img_html = ob_get_clean();
    }

    if ( ! $img_html ) {

        $thumbnail_rich = false;

        if ( isset( $args[ 'thumbnail_img_html' ] )) {
            $img_html = $args[ 'thumbnail_img_html' ];
        } else {

            if ( 'custom' == $thumbnail ) {
                $w = isset( $thumbnail_custom[ 'width'] ) ? $thumbnail_custom[ 'width'] : 480;
                $h = isset( $thumbnail_custom[ 'height'] ) ? $thumbnail_custom[ 'height'] : 320;
                $w = absint( $w );
                $h = absint( $h );
                if ( $w < 60 || $w > 3000 ) {
                    $w = 480;
                }
                if ( $h < 60 || $h > 2000 ) {
                    $w = 320;
                }
                if ( $w <= 150 ) {
                    $thumb = 'thumbnail';
                } elseif ( $w <= 320 ) {
                    $thumb = 'medium';
                } elseif ( $w <= 800 ) {
                    $thumb = 'large';
                } else {
                    $thumb = 'full';
                }
                $height_radio = $h/$w * 100;
                $img_html = wp_get_attachment_image( $thumbnail_img_id, $thumb, false, $attrs );
                $img_html = '<span class="imageframe56" style="padding-bottom:' . $height_radio . '%;">' . $img_html . '</span>';
            } else {
                $img_html = wp_get_attachment_image( $thumbnail_img_id, $thumbnail, false, $attrs );
            }

        }

    }

    /**
     * HOVER EFFECT
     */
    $cl[] = 'hover--' . $thumbnail_hover_effect;
    if ( 'letter' == $thumbnail_hover_effect ) {
        $plain_title = wp_strip_all_tags( get_the_title(), true );
        $letter = substr($plain_title,0,1);
        $inner_html .= '<span class="thumbnail56__letter font-heading">
            <span class="thumbnail56__letter__main">'
                . $letter . 
            '</span>
            <span class="thumbnail56__letter__cross thumbnail56__letter__cross--left"></span>
            <span class="thumbnail56__letter__cross thumbnail56__letter__cross--right"></span>
        </span>';
    }
    if ( 'logo' ==  $thumbnail_hover_effect ) {
        if ( ! empty( $thumbnail_hover_logo ) ) {
            // if we're provided image ID
            if ( is_numeric( $thumbnail_hover_logo ) ) {
                $inner_html .= wp_get_attachment_image( $thumbnail_hover_logo, 'large', false, [ 'class' => 'thumbnail56__hover-img' ] );
            } else {
                $inner_html .= fox56_image_from_url( $thumbnail_hover_logo, 'large', [ 'class' => 'thumbnail56__hover-img' ] );
            }
        }
    }
    if ( in_array( $thumbnail_hover_effect, [ 'dark', 'letter', 'logo' ] ) ) {
        $cl[] = 'hover--dark';
        $inner_html .= '<span class="thumbnail56__overlay"></span>';
    }

    /**
     * SHOWING EFFECT
     */
    if ( $thumbnail_showing_effect && 'none' != $thumbnail_showing_effect ) {
        $cl[] = 'thumbnail56--hasshowing';
        $cl[] = 'thumbnail56--hasshowing--' . $thumbnail_showing_effect;
    }

    /**
     * REVIEW SCORE
     */
    if ( $thumbnail_review ) {
        if ( fox56_get_review_score_number() ) {
            $score = fox56_get_review_score();
            $inner_html .= '<span class="thumbnail56__score">' . $score . '</span>';
        }
    }

    /**
     * VIEW
     */
    if ( $thumbnail_view ) {
        $viewcount = fox56_get_view();
        if ( $viewcount > 0 ) {
            $inner_html .= '<span class="thumbnail56__view">' . sprintf( fox_word( 'views' ), fox_number( $viewcount ) ) . '</span>';
        }
    }

    /**
     * FORMAT INDICATOR
     */
    if ( $thumbnail_format_indicator ) {
        $indicator = fox56_get_format_indicator();
        if ( $indicator ) {
            $inner_html .= '<span class="thumbnail56__format_indicator">' . $indicator . '</span>';
        }
    }

    $inner_html = apply_filters( 'fox56_thumbnail_inner', $inner_html, $args );

    /**
     * RICH/POOR
     */
    if ( $thumbnail_rich ) {
        $thumbnail_index = '';
        $inner_html = '';
    }

    /**
     * EXTRA CLASS
     */
    if ( ! empty( $thumbnail_class ) ) {
        $cl[] = $thumbnail_class;
    }
    ?>
    <figure class="<?php echo esc_attr( join( ' ', $cl )); ?>">
        <?php if ( $thumbnail_index ) {
            global $thumbnail_counter;
            if ( ! isset( $thumbnail_counter ) ) {
                $thumbnail_counter = 0;
            }
            $thumbnail_counter += 1;
            ?>
            <span class="thumbnail56__index"><?php echo $thumbnail_counter; ?></span>
        <?php } ?>
        <?php if ( ! $thumbnail_rich ) { ?>
        <a href="<?php the_permalink(); ?>"<?php echo fox56_link_target_attr(); ?>>
        <?php } ?>
            <?php echo $img_html; ?>
            <?php echo $inner_html; ?>
        <?php if ( ! $thumbnail_rich ) { ?>
        </a>
        <?php } ?>
        <?php if ( $thumbnail_caption ) {
            $caption_text = wp_get_attachment_caption( $thumbnail_img_id );
            if ( $caption_text ) { ?>
        <figcaption class="wp-caption-text thumbnail56__caption"><?php echo $caption_text; ?></figcaption>
        <?php }
        } ?>
    </figure>
    <?php
}

/**
 * must be used inside loop
 */
function fox56_title( $args = [] ) {
    extract( wp_parse_args( $args,[
        'title_tag' => 'h2',
        'title_extra_class' => '',
    ]) );
    $cl = [ 'title56', 'component56' ];
    if ( ! in_array( $title_tag, ['h2','h3','h4','h5'])) {
        $title_tag = 'h2';
    }
    if  (! empty ($title_extra_class) ) {
        $cl[] = $title_extra_class;
    }
    ?>
    <<?php echo $title_tag; ?> class="<?php echo esc_attr( join( ' ', $cl ) ); ?>">
        <a href="<?php the_permalink(); ?>"<?php echo fox56_link_target_attr(); ?>>
            <?php the_title(); ?>
        </a>
    </<?php echo $title_tag; ?>>
    <?php
}

/**
 * the permalink function that is compatible with AMP
 */
function fox56_permalink() {
    if ( function_exists( 'ampforwp_is_amp_endpoint' ) && ampforwp_is_amp_endpoint() && function_exists( 'amp_loop_permalink' ) ) {
        $permalink = amp_loop_permalink();
    } else {
        $permalink = get_permalink();
    }
    
    return $permalink;
}

/**
 * must be used inside loop
 */
function fox56_excerpt( $args = [] ) {
    extract( wp_parse_args( $args,[
        'excerpt_content' => 'excerpt',
        'excerpt_length' => 24,
        'display_excerpt_html' => get_theme_mod( 'display_excerpt_html', false ),
        'excerpt_hellip' => false,
        'excerpt_extra_class' => '',
    ]) );

    if ( 'content' == $excerpt_content ) {
        ob_start();
        the_content();
        $trimmed_text = ob_get_clean();
    } else {
        if ( $display_excerpt_html ) {
            ob_start();
            the_excerpt();
            $trimmed_text = ob_get_clean();
        } else {
            $excerpt_text = strip_tags( get_the_excerpt() );
            $trimmed_text = wp_trim_words( $excerpt_text, intval( $excerpt_length ), '' );

            if ( $excerpt_hellip ) {
                $trimmed_text .= '&hellip;';
            }
        }
    }

    // resolve &nbsp; problem
    $trimmed_text = str_replace( '&nbsp;', ' ', $trimmed_text );

    $cl = [ 'excerpt56', 'component56', $excerpt_extra_class ];
    ?>
    <div class="<?php echo esc_attr( join( ' ', $cl )); ?>">
        <?php echo $trimmed_text; ?>
    </div>
    <?php
}

/**
 * must be used inside loop
 */
function fox56_meta( $args = [] ) {
    extract( wp_parse_args( $args,[
        'meta_items' => [],
    ]) );
    $func_arr = [
        'live' => 'fox56_live_indicator',
        'date' => 'fox56_meta_date',
        'author' => 'fox56_meta_author',
        'comment' => 'fox56_meta_comment_link',
        'category' => 'fox56_meta_categories',
        'reading_time' => 'fox56_meta_reading_time',
        'view' => 'fox56_meta_view',
        'standalone_category' => 'fox56_standalone_categories'
    ];
    $func_arr = apply_filters( 'fox56_meta_functions', $func_arr );
    if ( empty( $meta_items ) ) {
        return;
    }
    ob_start();
    foreach( $meta_items as $item ) {
        $func = isset( $func_arr[ $item ] ) ? $func_arr[ $item ] : null;
        if ( ! $func ) { continue ; }
        call_user_func( $func, $args );
    }
    $inner_html = trim( ob_get_clean() );
    if ( empty( $inner_html) ) {
        return;
    }
    ?>
    <div class="meta56 component56">
        <?php echo $inner_html; ?>
    </div>
    <?php
}

function fox56_is_live() {
    return 'true' == get_post_meta( get_the_ID(), '_is_live', true );
}

function fox56_live_indicator() {
    
    if ( ! fox56_is_live() ) {
        return;
    }
    
    $diff = (int) abs( get_post_modified_time( 'U' ) - current_time( 'timestamp' ) );
    
    if ( $diff < 60 ) {
        
        $time = fox_word( 'justnow' );
        
    } else {
    
        $time = sprintf( fox_word( 'ago' ), human_time_diff( get_post_modified_time( 'U' ), current_time( 'timestamp' ) ) );
        
    }

    $cl = [ 'meta56__item', 'meta56__live_indicator', 'live-indicator' ];
    
    ?>

<span class="<?php echo esc_attr( join( ' ', $cl ) ); ?>">
    
    <span class="live-circle"></span>
    
    <span class="live-word"><?php echo fox_word( 'live' ); ?></span>
    
    <span class="live-updated">
    
        <time class="published" itemprop="dateModified" datetime="<?php echo get_the_modified_date( DATE_W3C ); ?>">
            
            <?php echo $time ;?>
    
        </time>
        
    </span>

</span>
      
    <?php
    
}

/**
 * date
 */
function fox56_meta_date( $args = [] ) {
    extract( wp_parse_args( $args,[
        'date_format' => '',
        'date_type' => '',
    ]) );

    /* updated/published
    ----------------- */
    if ( ! $date_type ) {
        $date_type = get_theme_mod( 'date_type', 'publish' );
    }

    $time_style = get_theme_mod( 'time_style', 'standard' );
    if ( 'human' == $time_style ) {

        if ( 'updated' == $date_type ) {
            $posttime = get_the_modified_time( 'U' );
            $title = get_the_modified_date( 'd M, Y H:s:i' );
        } else {
            $posttime = get_the_time( 'U' );
            $title = get_the_date( 'd M, Y H:s:i' );
        }

        $date_html = sprintf( fox_word( 'ago' ), human_time_diff( $posttime, current_time( 'timestamp' ) ) );

    } else {

        if ( ! $date_format ) {
            $date_format = get_option( 'date_format' );
        }
        
        if ( 'updated' == $date_type ) {
            $date_html = get_the_modified_date( $date_format );
            $title = get_the_modified_date( 'd M, Y H:s:i' );
        } else {
            $date_html = get_the_date( $date_format );
            $title = get_the_date( 'd M, Y H:s:i' );
        }

    }

    /* classes
    ----------------- */
    $cl = [ 'meta56__item', 'meta56__date' ];
    ?>
    <div class="<?php echo esc_attr( join( ' ', $cl ) ); ?>" title="<?php echo esc_attr( $title ); ?>">
        <?php echo $date_html; ?>
    </div>
    <?php
}

/**
 * author
 */
function fox56_meta_author( $args = [] ) {
    extract( wp_parse_args( $args,[
        'author_avatar' => false,
    ]) );

    if ( function_exists( 'get_coauthors' ) ) {
        $authors = get_coauthors();
    } else {
        global $post;
        $author_id = $post->post_author;
        $authors = [ get_userdata( $author_id ) ];
    }

    $count = 0;
    $author_html = '';
    $ul = [];
    foreach ( $authors as $user ) {
        
        $author_id = $user->ID;
        $count++;
        
        $link = get_author_posts_url( $user->ID, $user->user_nicename );
        $li = '';

        if ( $author_avatar ) {
            $li .=  get_avatar( $author_id, 80 );
        }
        $li .= $user->display_name;
        $li = '<a href="' . esc_url( $link ) . '" itemprop="url" rel="author">' . $li . '</a>';
        $ul[] = $li;

    }
    if ( count($ul) > 1 ) {
        $author_html = join( '<span class="meta56__author__sep">' . esc_html__( 'and', 'wi' ) . '</span>', $ul );
    } elseif ( ! empty( $ul ) ) {
        $author_html = $ul[0];
    }
    if ( ! empty( $ul ) ) {
        // be careful at this point: make sure $by_author has %s
        if ( 1 == count( $authors ) ) {
            $by_author = fox_word( 'author' );
            if ( strpos( $by_author, '%s' ) !== false ) {
                $author_html = sprintf( fox_word( 'author' ), $author_html );
            }
        }
    } else {
        return;
    }

    $cl = [ 'meta56__item', 'meta56__author' ];
    ?>
    <div class="<?php echo esc_attr( join( ' ', $cl ) ); ?>">
        <?php echo $author_html; ?>
    </div>
    <?php
}

/**
 * category
 */
function fox56_meta_categories( $args = [] ) {
    extract( wp_parse_args( $args,[
        'category_tax' => 'category',
    ]) );
    if ( ! $category_tax ) {
        $category_tax = 'category';
    }
    $output = get_the_term_list( get_the_ID(), $category_tax, '', '<span class="sep">&middot;</span>' );
    if ( ! $output ) {
        return;
    }

    $cl = [ 'meta56__item', 'meta56__category' ];
    ?>
    <div class="<?php echo esc_attr( join( ' ', $cl ) ); ?>">
        <?php if ( is_wp_error( $output ) ) {
            if ( current_user_can( 'manage_options' ) ) { echo '<span class="fox-error">' . $output->get_error_message() . '</span>'; }
        } else {
            echo $output; 
        } ?>
    </div>
    <?php
}

/**
 * fox56_meta_reading_time
 */
function fox56_meta_reading_time( $args = [] ) {
    $cl = [ 'meta56__item', 'meta56__reading-time' ];

    global $post;

    $reading_speed = get_theme_mod( 'reading_speed', 250 );
    $reading_speed = apply_filters( 'fox_reading_speed', $reading_speed );
    $reading_speed = absint( $reading_speed );
    if ( $reading_speed > 10000 || $reading_speed < 1 ) {
        $reading_speed = 250;
    }
    
    $words = str_word_count( strip_tags( $post->post_content ), 0, 'АБВГДЕЁЖЗИЙКЛМНОПРСТУФХЦЧШЩЪЫЬЭЮЯабвгдеёжзийклмнопрстуфхцчшщъыьэюя' );
    $mins = floor( $words / $reading_speed );

    if ( 1 < $mins ) {
        $estimated_time = sprintf( fox_word( 'mins_read' ), $mins );
    } else {
        $estimated_time = fox_word( 'min_read' );
    }

    ?>
    <div class="<?php echo esc_attr( join( ' ', $cl )); ?>">
        <?php echo $estimated_time; ?>
    </div>
    <?php
}

function fox56_standalone_categories( $args = [] ) {
    extract( wp_parse_args( $args,[
        'category_tax' => 'category',
        'fancy_category_style' => '',
    ]) );
    if ( ! $category_tax ) {
        $category_tax = 'category';
    }
    $output = get_the_term_list( get_the_ID(), $category_tax, '', '<span class="sep">&middot;</span>' );
    if ( ! $output ) {
        return;
    }

    /* ------------------       style */
    if ( ! $fancy_category_style ) {
        $fancy_category_style = get_theme_mod( 'standalone_category_style', 'plain' );
    }

    $cl = [ 'meta56__item', 'meta56__category--fancy', 'meta56__category--fancy--' . $fancy_category_style ];
    ?>
    <div class="<?php echo esc_attr( join( ' ', $cl ) ); ?>">
    <?php if ( is_wp_error( $output ) ) {
        if ( current_user_can( 'manage_options' ) ) { echo '<span class="fox-error">' . $output->get_error_message() . '</span>'; }
    } else {
        echo $output; 
    } ?>
    </div>
<?php }

/* READ MORE
=============================================================== */
function fox56_readmore( $args = [] ) {
    extract( wp_parse_args( $args,[
        'more_style' => 'primary',
    ]) );
    $btn_cl = [ 'btn56', 'btn56--' . $more_style, 'more--btn' ];

    $cl = [ 'readmore56', 'component56' ];
    if ( 'plain' == $more_style ) { ?>
<div class="<?php echo esc_attr(join( ' ', $cl)); ?>">
    <a href="<?php the_permalink(); ?>" class="more--plain"><?php echo fox_word( 'read_more' ); ?></a>
</div>
    <?php } elseif ( 'minimal' == $more_style ) { ?>
        <div class="<?php echo esc_attr(join( ' ', $cl)); ?>">
            <a href="<?php the_permalink(); ?>" class="more--minimal"><?php echo fox_word( 'read_more' ); ?></a>
        </div>
    <?php } else {
        $cl[] = 'button56'; ?>
<div class="<?php echo esc_attr(join( ' ', $cl)); ?>">
    <a href="<?php the_permalink(); ?>" class="<?php echo esc_attr( join( ' ', $btn_cl ) ); ?>"<?php echo fox56_link_target_attr(); ?>><?php echo fox_word( 'read_more' ); ?></a>
</div>
<?php }
}

/* PAGE THUMBNAIL
=============================================================== */
function fox56_page_thumbnail() {
    $show_hide = get_post_meta( get_the_ID(), '_wi_thumbnail', true );
    
    if ( 'true' == $show_hide ) {
        $show = true;
    } elseif ( 'false' == $show_hide ) {
        $show = false;
    } else {
        $show = true;
    }
    if ( ! $show ) {
        return;
    }

    $thumbnail_id = get_post_thumbnail_id();
    if (! $thumbnail_id ) {
        return;
    }
    $cl = [ 'single_thumbnail56', 'thumbnail56--standard', 'post-thumbnail', 'page-thumbnail' ];
    $caption = wp_get_attachment_caption( $thumbnail_id );
    ?>
    <div class="single56__thumbnail page56__thumbnail single56__block">
        <figure class="<?php echo esc_attr( join( ' ', $cl) ); ?>">
            <?php the_post_thumbnail( 'full', [ 'loading' => 'eager' ] ); ?>
            <?php if ( $caption ) { ?>
            <figcaption>
                <?php echo $caption; ?>
            </figcaption>
            <?php } ?>
        </figure>
    </div>
    <?php
}

/* SINGLE THUMBNAIL
=============================================================== */
function fox56_single_thumbnail() {
    $show_hide = get_post_meta( get_the_ID(), '_wi_thumbnail', true );
    
    if ( 'true' == $show_hide ) {
        $show = true;
    } elseif ( 'false' == $show_hide ) {
        $show = false;
    } else {
        $show = ! get_theme_mod( 'disable_single_thumbnail' );
    }
    if ( ! $show ) {
        return;
    }

    $inner = fox56_single_thumbnail_inner();
    if ( empty($inner)) {
        return;
    }
    ?>
    <div class="single56__thumbnail single56__block"><?php echo $inner; ?></div>
    <?php
}
function fox56_single_thumbnail_inner() {
    ob_start();
    $format = get_post_format();
    switch( $format ) {
        /* ------------------------------- video */
        case 'video' :
            fox56_single_video();
        break;

        /* ------------------------------- audio */
        case 'audio' :
            fox56_single_audio();
        break;

        /* ------------------------------- gallery */
        case 'gallery' :
            fox56_single_gallery();
        break;

        /* ------------------------------- default */
        default :
            fox56_single_thumbnail_default();
        break;
    }
    return ob_get_clean();
}

/**
 * VIDEO FORMAT
 */
function fox56_single_video() {
    $video = get_post_meta( get_the_ID(), '_format_video', true );
    $video_url = '';
    $media_attempt = '';
    $caption = '';
    $cl = [ 'single_thumbnail56', 'thumbnail56--video' ];
    if ( ! $video_url ) {
            
        $media_code = get_post_meta( get_the_ID(), '_format_video_embed', true );
        
        // if we have iframe, take it
        if ( stripos( $media_code,'<iframe') > -1 ) {
            
            $media_attempt = $media_code;
            
        } elseif ( substr( $media_code, 0, 1 ) == '[' ) {
            
            $media_attempt = do_shortcode( $media_code );
        
        // otherwise, it's a URL    
        } else {
            
            $url = $media_code;
            $parse = parse_url( home_url( '/' ) );
            $host = preg_replace('#^www\.(.+\.)#i', '$1', $parse['host']);
            
            // it's not a self-hosted video
            // just a backward compatibility
            if ( strpos( $url, $host ) === false ) {
                
                global $wp_embed;
                $media_attempt = $wp_embed->run_shortcode( '[embed width="640" height="360"]' . $url . '[/embed]' );
                
            } else {
                
                $video_url = $url;
                
            }
        
        }
        if ( $video ) {
            $video_url = wp_get_attachment_url( $video );
        }
        
        // atempt when we have self-hosted URL
        if ( $video_url ) {
            
            $content_width = 1080;
            $height = $content_width * 9 / 16;
                
            $args = [
                'src' => $video_url,
                'loop' => 'on',
                'autoplay' => true,
                'width' => $content_width,
                'height' => $height,
            ];

            if ( has_post_thumbnail( get_the_ID() ) ) {
                $args[ 'poster' ] = wp_get_attachment_url( get_post_thumbnail_id( get_the_ID() ) );
            }

            $media_attempt = wp_video_shortcode( $args );
            
            // try to get video ID from its URL
            if ( ! $video ) $video = attachment_url_to_postid( $video_url );
            if ( $video ) {
                $get_caption = wp_get_attachment_caption( $video );
                if ( $get_caption ) {
                    
                    $caption .= '<figcaption class="post-thumbnail-caption video-caption thumbnail56__caption">';
                    $caption .= wp_kses( $get_caption, fox_allowed_html() );
                    $caption .= '</figcaption>';
                    
                }
            }
            
        }
        if ( $media_attempt ) {
        
            echo '<figure class="' . esc_attr( join( ' ', $cl ) ) . '"><div class="media-container">' . $media_attempt . $caption . '</div></figure>';
        
        } else {
        
            echo '<div class="fox-error">Please go to your <strong>Post editor &raquo; Post Settings &raquo; Post Formats</strong> tab below your editor to enter video URL.</div>';    
        
        }
        
    }
}
function fox56_single_audio() {

    $cl = [ 'single_thumbnail56', 'thumbnail56--audio' ];
    $postid = get_the_ID();
        
    // the self-hosted audio
    $audio = get_post_meta( $postid, '_format_audio', true );
    $audio_url = '';
    $media_attempt = '';
    $cover_img = '';
    $caption = '';
    
    // still can't have a result
    // try to embed code
    if ( ! $audio_url ) {
        
        $media_code = get_post_meta( $postid, '_format_audio_embed', true );
        
        // if we have iframe, take it
        if ( stripos( $media_code,'<iframe') > -1 ) {
            
            $media_attempt = $media_code;
            
        } elseif ( substr( $media_code, 0, 1 ) == '[' ) {
            
            $media_attempt = do_shortcode( $media_code );
        
        // otherwise, it's a URL    
        } else {
            
            $url = $media_code;
            $parse = parse_url( home_url( '/' ) );
            if ( ! is_string( $parse['host'] ) ) {
                $parse['host'] = '';
            }
            $host = preg_replace('#^www\.(.+\.)#i', '$1', $parse['host']);
            
            // it's not a self-hosted audio
            // just a backward compatibility
            if ( strpos( $url, $host ) === false ) {
                
                global $wp_embed;
                $media_attempt = $wp_embed->run_shortcode( '[embed]' . $url . '[/embed]' );
                
            } else {
                
                $audio_url = $url;
                
            }
        
        }
        
    }
    
    if ( $audio ) {
        $audio_url = wp_get_attachment_url( $audio );
    }
    
    // atempt when we have self-hosted URL
    if ( $audio_url ) {
        
        $args = [
            'src' => $audio_url,
            'loop' => 'on',
            'autoplay' => true,
        ];
        
        if ( has_post_thumbnail( $postid ) ) {
            $figclass = [
                'wi-self-hosted-audio-poster self-hosted-audio-poster'
            ];
            $cover_img = '<div class="' . esc_attr( join( ' ', $figclass ) ) . '">' . wp_get_attachment_image( get_post_thumbnail_id( $postid ), 'full' ). '</div>';
        }

        $media_attempt = wp_audio_shortcode( $args );
        
        // try to get audio ID from its URL
        if ( ! $audio ) $audio = attachment_url_to_postid( $audio_url );
        if ( $audio ) {
            $get_caption = wp_get_attachment_caption( $audio );
            if ( $get_caption ) {
                
                $caption .= '<figcaption class="post-thumbnail-caption audio-caption thumbnail56__caption">';
                $caption .= wp_kses( $get_caption, fox_allowed_html() );
                $caption .= '</figcaption>';
                
            }
        }
        
    }
    
    if ( $media_attempt ) {
    
        echo '<div class="' . esc_attr( join( ' ', $cl ) ) . '"><div class="media-container">' . $cover_img . $media_attempt . $caption . '</div></div>';
    
    } else {
    
        echo '<div class="fox-error">Please go to your post editor > Post Settings > Post Formats tab below your editor to enter audio URL.</div>';
    
    }

}
function fox56_single_gallery() {

    $postid = get_the_ID();

    /**
     * get image
     */
    $images = get_post_meta( $postid, '_format_gallery_images', true );
    if ( empty( $images ) ) {
        if ( current_user_can( 'manage_options') ) {
            echo '<div class="fox-error">No images for your gallery post format. Please go to your post editor > Post Settings > Post Formats tab below your editor to upload images there.</div>'; 
        }
        return;
    }
    if ( ! is_array( $images ) ) {
        $images = explode( ',', strval( $images ) );
        $images = array_map( 'trim', $images );
    }

    /**
     * style
     */
    $style = get_post_meta( $postid, '_wi_format_gallery_style', true );
    if ( ! $style ) {
        $style = get_theme_mod( 'single_format_gallery_style', 'metro' );
    }

    /**
     * lightbox
     */
    $has_lightbox = get_post_meta( $postid, '_wi_format_gallery_lightbox', true );
    if ( 'true' == $has_lightbox ) {
        $has_lightbox = true;
    } elseif ( 'false' == $has_lightbox ) {
        $has_lightbox = false;
    } else {
        $has_lightbox = get_theme_mod( 'single_format_gallery_lightbox', true );
    }

    switch( $style ) {

        /* ---------------------- grid */
        case 'grid' :
            
            /**
             * col
             */
            $col = get_post_meta( $postid, '_wi_format_gallery_grid_column', true );
            if ( ! $col ) {
                $col = get_theme_mod( 'single_format_gallery_grid_column', 3 );
            }
            $col = absint( $col );
            if ( $col < 1 || $col > 5 ) {
                $col = 3;
            }
            $cl = [ 'single_thumbnail56', 'gallery56', 'gallery56--grid', 'gallery56--normal', 'gallery56--grid--' . $col . 'cols' ];

            /**
             * lightbox
             */
            if ( $has_lightbox ) {
                $cl[] = 'gallery56--lightbox';
            }

            /**
             * grid size
             */
            $grid_size = get_post_meta( $postid, '_wi_format_gallery_grid_size', true );
            if ( ! $grid_size ) {
                $grid_size = get_theme_mod( 'single_format_gallery_grid_size', 'landscape' );
            }
            if ( in_array( $grid_size, [ 'landscape', 'square', 'portrait' ] ) ) {
                $cl[] = 'gallery56--grid--custom';
            }
            $cl[] = 'gallery56--grid--' . $grid_size;
            if ( 'custom' == $grid_size ) {
                $custom_size = trim( strval( get_post_meta( $postid, '_wi_format_gallery_grid_size_custom', true ) ) );
                if ( ! $custom_size ) {
                    $custom_size = get_theme_mod( 'single_format_gallery_grid_size_custom' );
                }
                $explode = explode( 'x', $custom_size );
                if ( isset( $explode[0]) && isset( $explode[1] ) ) {
                    $w = intval( $explode[0] );
                    $h = intval( $explode[1] );
                    if ( $w > 0 && $h > 0 ) {
                        $padding = $h/$w * 100;
                        echo '<style>.post-' . $postid . ' .gallery56--grid figure{padding-bottom:'.$padding.'%;}</style>';
                    }
                }
            }

            /**
             * col
             */
            if ( $col < 3 ) {
                $size = 'large';
            } else {
                $size = 'medium';
            }
            ?>
            <div class="<?php echo esc_attr( join( ' ', $cl ) ); ?>">
                <?php foreach ( $images as $image_id ) {
                    $img_full_src = wp_get_attachment_image_src( $image_id, 'full' );
                    $img_html = wp_get_attachment_image( $image_id, $size );
                    if ( ! $img_full_src ) {
                        continue;
                    }
                    $caption = wp_get_attachment_caption( $image_id );
                    ?>
                <figure>
                    <?php if ($has_lightbox){ ?><a href="<?php echo $img_full_src[0]; ?>"><?php } ?>
                        <?php echo $img_html; ?>
                    <?php if ($has_lightbox){ ?></a><?php } ?>
                    <?php if ( $caption ) { ?>
                    <figcaption><?php echo $caption; ?></figcaption>
                    <?php } ?>
                </figure>
                <?php } ?>
            </div>
        <?php break;

        /* ---------------------- masonry */
        case 'masonry' :
            $cl = [ 'single_thumbnail56', 'gallery56', 'gallery56--masonry', 'gallery56--normal', 'masonry56' ];
            /**
             * lightbox
             */
            if ( $has_lightbox ) {
                $cl[] = 'gallery56--lightbox';
            }
            
            /**
             * col
             */
            $col = get_post_meta( $postid, '_wi_format_gallery_grid_column', true );
            if ( ! $col ) {
                $col = get_theme_mod( 'format_gallery_grid_column', 3 );
            }
            $col = absint( $col );
            if ( $col < 1 || $col > 5 ) {
                $col = 3;
            }
            if ( $col < 3 ) {
                $size = 'large';
            } else {
                $size = 'medium';
            }
            $cl[] = 'gallery56--masonry--' . $col . 'cols';
            ?>
            <div class="<?php echo esc_attr( join( ' ', $cl ) ); ?>">
                <div class="main-masonry">
                    <?php foreach ( $images as $image_id ) {
                        $img_full_src = wp_get_attachment_image_src( $image_id, 'full' );
                        $img_html = wp_get_attachment_image( $image_id, $size );
                        if ( ! $img_full_src ) {
                            continue;
                        }
                        $caption = wp_get_attachment_caption( $image_id );
                        if ( $caption ) {
                            $figure_class = 'has-caption';
                        } else {
                            $figure_class = '';
                        }
                        ?>
                    <figure class="<?php echo esc_attr( $figure_class ); ?>">
                        <?php if ($has_lightbox){ ?><a href="<?php echo $img_full_src[0]; ?>"><?php } ?>
                            <?php echo $img_html; ?>
                        <?php if ($has_lightbox){ ?></a><?php } ?>
                        <?php if ( $caption ) { ?>
                        <figcaption><?php echo $caption; ?></figcaption>
                        <?php } ?>
                    </figure>
                    <?php } ?>
                    <div class="grid-sizer"></div>
                </div>
            </div>
            <?php
        break;

        /* ---------------------- masonry */
        case 'metro' :
            $cl = [ 'single_thumbnail56', 'gallery56', 'gallery56--metro', 'gallery56--normal' ];
            /**
             * lightbox
             */
            if ( $has_lightbox ) {
                $cl[] = 'gallery56--lightbox';
            } ?>
            <div class="<?php echo esc_attr( join( ' ', $cl ) ); ?>">
                <?php foreach ( $images as $image_id ) {
                    $img_full_src = wp_get_attachment_image_src( $image_id, 'full' );
                    $img_html = wp_get_attachment_image( $image_id, 'large' );
                    if ( ! $img_full_src ) {
                        continue;
                    }
                    $caption = wp_get_attachment_caption( $image_id );
                    if ( $caption ) {
                        $figure_class = 'has-caption';
                    } else {
                        $figure_class = '';
                    }
                    ?>
                <figure class="<?php echo esc_attr( $figure_class ); ?>">
                    <?php if ($has_lightbox){ ?><a href="<?php echo $img_full_src[0]; ?>"><?php } ?>
                        <?php echo $img_html; ?>
                    <?php if ($has_lightbox){ ?></a><?php } ?>
                    <?php if ( $caption ) { ?>
                    <figcaption><?php echo $caption; ?></figcaption>
                    <?php } ?>
                </figure>
                <?php } ?>
            </div>
            <?php
        break;

        /* ---------------------- stack */
        case 'stack' :
            $cl = [ 'single_thumbnail56', 'gallery56', 'gallery56--stack' ];
            
            /**
             * lightbox
             */
            if ( $has_lightbox ) {
                $cl[] = 'gallery56--lightbox';
            }
            ?>
            <div class="<?php echo esc_attr( join( ' ', $cl ) ); ?>">
                <?php foreach ( $images as $image_id ) {
                    $img_full_src = wp_get_attachment_image_src( $image_id, 'full' );
                    $img_html = wp_get_attachment_image( $image_id, 'large' );
                    if ( ! $img_full_src ) {
                        continue;
                    }
                    $caption = wp_get_attachment_caption( $image_id );
                    if ( $caption ) {
                        $figure_class = 'has-caption';
                    } else {
                        $figure_class = '';
                    }
                    ?>
                <figure class="<?php echo esc_attr( $figure_class ); ?>">
                    <?php if ($has_lightbox){ ?><a href="<?php echo $img_full_src[0]; ?>"><?php } ?>
                        <?php echo $img_html; ?>
                    <?php if ($has_lightbox){ ?></a><?php } ?>
                    <?php if ( $caption ) { ?>
                    <figcaption><?php echo $caption; ?></figcaption>
                    <?php } ?>
                </figure>
                <?php } ?>
            </div>
            <?php
        break;

        /* ---------------------- slider */
        case 'slider' :
            $cl = [ 'single_thumbnail56', 'gallery56', 'gallery56--normal', 'gallery56--slider', 'carousel56', 'carousel56--1cols', 'carousel56--tablet--1cols', 'carousel56--mobile--1cols', 'nav--middle-edge', 'nav--high-square', 'nav--outline' ];
            $options = [
                'cellAlign' => 'left',
                'groupCells' => '100%',
                'imagesLoaded' => true,
                'wrapAround' => true, // infinte scroll
                'dragThreshold' => 5,
                'pageDots' => false,
                'autoPlay' => 5000,
                'pauseAutoPlayOnHover' => true,
                'pageDots' => false,
            ];
            ?>
            <div class="<?php echo esc_attr( join( ' ', $cl ) ); ?>" data-options='<?php echo json_encode( $options ); ?>'>
                <div class="main-carousel">
                    <?php foreach ( $images as $image_id ) {
                        $img_full_src = wp_get_attachment_image_src( $image_id, 'full' );
                        $img_html = wp_get_attachment_image( $image_id, 'full' );
                        if ( ! $img_full_src ) {
                            continue;
                        }
                        $caption = wp_get_attachment_caption( $image_id );
                        if ( $caption ) {
                            $figure_class = 'has-caption';
                        } else {
                            $figure_class = '';
                        }
                        ?>
                    <div class="carousel-cell">    
                        <figure class="<?php echo esc_attr( $figure_class ); ?>">
                            <?php echo $img_html; ?>
                            <?php if ( $caption ) { ?>
                            <figcaption><?php echo $caption; ?></figcaption>
                            <?php } ?>
                        </figure>
                    </div>
                    <?php } ?>
                </div><!-- .main-carousel -->
            </div>
            <?php
        break;

        /* ---------------------- slider rich */
        case 'slider-rich' :
            $cl = [ 'single_thumbnail56', 'gallery56', 'gallery56--normal', 'gallery56--slider-rich', 'carousel56', 'carousel56--1cols', 'carousel56--tablet--1cols', 'carousel56--mobile--1cols', 'nav--middle-edge', 'nav--high-square', 'nav--dark' ];
            $options = [
                'cellAlign' => 'left',
                'groupCells' => '100%',
                'imagesLoaded' => true,
                'wrapAround' => true, // infinte scroll
                'dragThreshold' => 5,
                'pageDots' => false,
                'autoPlay' => 5000,
                'pauseAutoPlayOnHover' => true,
                'pageDots' => false,
            ];
            ?>
            <div class="<?php echo esc_attr( join( ' ', $cl ) ); ?>" data-options='<?php echo json_encode( $options ); ?>'>
                <div class="main-carousel">
                    <?php foreach ( $images as $image_id ) {

                        $attachment = get_post( $image_id );
                        if ( ! $attachment ) continue;

                        $title = $attachment->post_title;
                        $description = do_shortcode( $attachment->post_content );

                        $img_full_src = wp_get_attachment_image_src( $image_id, 'full' );
                        $img_html = wp_get_attachment_image( $image_id, 'large' );
                        if ( ! $img_full_src ) {
                            continue;
                        }
                        ?>
                    <div class="carousel-cell">
                        <div class="gallery56__richitem">

                            <figure class="gallery56__richitem__image">
                                <?php echo $img_html; ?>
                            </figure>

                            <div class="gallery56__richitem__text">
                                <?php if ( $title ) { ?>
                                <h3 class="gallery56__richitem__title" itemprop="headline">
                                    <?php echo esc_html( $title ); ?>
                                </h3>
                                <?php } ?>
                                
                                <?php if ( $description ) { ?>
                                <div class="gallery56__richitem__description">
                                    <?php echo $description; ?>
                                </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                </div><!-- .main-carousel -->
            </div>
            <?php
        break;

        /* ---------------------- carousel */
        case 'carousel' :
            $cl = [ 'single_thumbnail56', 'gallery56', 'gallery56--normal', 'gallery56--carousel', 'carousel56', 'nav--middle-edge', 'nav--high-square', 'nav--outline' ];
            $options = [
                'cellAlign' => 'left',
                'groupCells' => '100%',
                'imagesLoaded' => true,
                'wrapAround' => true, // infinte scroll
                'dragThreshold' => 5,
                'pageDots' => false,
                'autoPlay' => 5000,
                'pauseAutoPlayOnHover' => true,
                'pageDots' => false,
            ];
            ?>
            <div class="<?php echo esc_attr( join( ' ', $cl ) ); ?>" data-options='<?php echo json_encode( $options ); ?>'>
                <div class="main-carousel">
                    <?php foreach ( $images as $image_id ) {
                        $img_full_src = wp_get_attachment_image_src( $image_id, 'full' );
                        $img_html = wp_get_attachment_image( $image_id, 'full' );
                        if ( ! $img_full_src ) {
                            continue;
                        }
                        $caption = wp_get_attachment_caption( $image_id );
                        if ( $caption ) {
                            $figure_class = 'has-caption';
                        } else {
                            $figure_class = '';
                        }
                        ?>
                    <div class="carousel-cell">    
                        <figure class="<?php echo esc_attr( $figure_class ); ?>">
                            <?php if ($has_lightbox){ ?><a href="<?php echo $img_full_src[0]; ?>"><?php } ?>
                                <?php echo $img_html; ?>
                            <?php if ($has_lightbox){ ?></a><?php } ?>
                            <?php if ( $caption ) { ?>
                            <figcaption><?php echo $caption; ?></figcaption>
                            <?php } ?>
                        </figure>
                    </div>
                    <?php } ?>
                </div><!-- .main-carousel -->
            </div>
            <?php
        break;

    }

}

add_shortcode( 'fox_gallery', 'fox56_gallery_shortcode' );
function fox56_gallery_shortcode() {
    ob_start();
    fox56_single_gallery();
    return ob_get_clean();
}

function fox56_single_thumbnail_default() {
    $thumbnail_id = get_post_thumbnail_id();
    if (! $thumbnail_id ) {
        return;
    }
    $cl = [ 'single_thumbnail56', 'thumbnail56--standard', 'post-thumbnail' ];
    $caption = wp_get_attachment_caption( $thumbnail_id );
    ?>
    <figure class="<?php echo esc_attr( join( ' ', $cl) ); ?>">
        <?php the_post_thumbnail( 'full', [ 'loading' => 'eager' ] ); ?>
        <?php if ( $caption ) { ?>
        <figcaption>
            <?php echo $caption; ?>
        </figcaption>
        <?php } ?>
    </figure>
    <?php
}

/* SINGLE TITLE
=============================================================== */
function fox56_single_title( $args = [] ) { ?>
    <h1 class="post-title single56__title component56"><?php the_title(); ?></h1>
<?php }

/* SINGLE CONTENT
=============================================================== */
function fox56_page_links() {
    wp_link_pages( array(
        'before'      => '<div class="page-links-container"><div class="page-links"><span class="page-links-label">' . esc_html__( 'Pages:', 'wi' ) . '</span>',
        'after'       => '</div></div>',
        'link_before' => '<span class="page-number">',
        'link_after'  => '</span>',
    ) );
}
function fox56_single_content( $args = [] ) { ?>
    <div class="entry-content single56__content single56__post_content single56__body_area">
        <?php
            the_content();
            fox56_page_links(); ?>
    </div>
    <?php
}

/* RELATED POSTS
=============================================================== */
function fox56_related( $args = [] ) {
    ?>
    <div class="single56__related"><?php fox56_single_related_inner(); ?></div>
    <?php
}
function fox56_primary_cat( $exclude_categories = [] ) {
    $cat = null;
    $primary_cat = get_post_meta( get_the_ID(), '_wi_primary_cat', true );
    $terms = wp_get_post_terms( get_the_ID(), 'category', array( 'fields' => 'ids' ) );
    if ( ! $terms ) {
        // and why?
        return;
    }
    if ( in_array( $primary_cat, $terms ) ) {
        $cat = $primary_cat;
    } else {
        $terms = array_diff( $terms, $exclude_categories );
        if ( $terms ) {
            
            $chosen_one = false;
            $highest_priority = -1;
            foreach( $terms as $term ) {
                $priority = intval( get_term_meta( $term, '_wi_priority', true ) );
                if ( $priority > $highest_priority ) {
                    $chosen_one = $term;
                    $highest_priority = $priority;
                }
            }
            $cat = $chosen_one;
            
        } else {
            $cat = $exclude_categories[0];
            $exclude_categories = [];
        }
    }
    return $cat;
}
function fox56_related_query( $args = [] ) {
    extract( wp_parse_args( $args, array(
        'number' => null,
        'orderby' => 'date',
        'order' => 'DESC',
        // tag, category, author, latest, featured
        'source' => 'tag',
        'exclude_categories' => [],
    ) ) );
    
    if ( ! is_array( $exclude_categories ) ) {
        $exclude_categories = explode( ',', $exclude_categories );
    }
    
    $query_args = [
        'posts_per_page' => $number,
        'post__not_in' => [ get_the_ID() ],
    ];
    
    if ( 'author' == $source ) {
        
        $query_args[ 'author' ] = get_the_author_meta( 'ID' );
        
    } elseif ( 'category' == $source ) {
        
        $primary_cat = fox56_primary_cat( $exclude_categories );
        if ( ! $primary_cat ) {
            return;
        }
        $query_args[ 'cat' ] = $primary_cat;
        
    } elseif ( 'tag' == $source ) {
        
        $terms = wp_get_post_terms( get_the_ID(), 'post_tag', array( 'fields' => 'ids' ) );
        if ( empty( $terms ) ) return;
        
        $query_args[ 'tag__in' ] = $terms;
    
    } elseif ( 'date' == $source ) {
        
        $query_args[ 'orderby' ] = 'date';
        $query_args[ 'order' ] = 'DESC';
        
    } elseif ( 'featured' == $source ) {
        
        $query_args[ 'featured' ] = true;
        
    }
    
    if ( $exclude_categories ) {
        $query_args[ 'category__not_in' ] = $exclude_categories;
    }

    /* ---------------- orderby */
    if ( 'view' === $orderby ) {
            
        $query_args[ 'orderby' ] = 'post_views';
        $query_args[ 'order' ] = $order;
        
    } elseif ( 'view_week' == $orderby ) {
        
        $query_args[ 'orderby' ] = 'post_views';
        $query_args[ 'views_query' ] = [
            'year' => date('Y'),
            'week' => date('W'),
        ];
        $query_args[ 'order' ] = $order;
        
    } elseif ( 'view_month' == $orderby ) {
        
        $query_args[ 'orderby' ] = 'post_views';
        $query_args[ 'views_query' ] = [
            'year' => date('Y'),
            'month' => date('n'),
        ];
        $query_args[ 'order' ] = $order;
        
    } elseif ( 'view_year' == $orderby ) {
        
        $query_args[ 'orderby' ] = 'post_views';
        $query_args[ 'views_query' ] = [
            'year' => date('Y'),
        ];
        $query_args[ 'order' ] = $order;
        
    } elseif ( 'review_score' == $orderby || 'review_date' == $orderby ) {
        
        $query_args[ 'orderby' ] = 'meta_value_num';
        $query_args[ 'meta_key' ] = '_wi_review_average';
        $query_args[ 'meta_value_num' ] = 0;
        $query_args[ 'meta_compare' ] = '>';
        
        if ( 'review_date' == $orderby ) {
            $query_args[ 'orderby' ] = 'date';
        }
        
        $query_args[ 'order' ] = $order;
        
    } else {
        
        $query_args[ 'orderby' ] = $orderby;
        $query_args[ 'order' ] = $order;
        
    }

    return new WP_Query( $query_args );

}

function fox56_single_related_inner() {

    /* ---------------------- query args */
    $query = fox56_related_query([
        'number' => get_theme_mod( 'single_related_number', 3 ),
        'source' => get_theme_mod( 'single_related_source', 'tag' ),
        'orderby' => get_theme_mod( 'single_related_orderby', 'date' ),
        'order' => get_theme_mod( 'single_related_order', 'DESC' ),
        'exclude_categories' => get_theme_mod( 'single_related_exclude_categories', '' ),
    ]);

    if ( ! $query || ! $query->have_posts() ) {
        wp_reset_query();
        return;
    }

    /* ---------------------- heading */
    $heading = get_theme_mod( 'single_related_heading', 'Related Posts' );
    if ( $heading ) { ?>
    <h2 class="single56__heading"><span><?php echo $heading; ?></span></h2>
    <?php }

        $args = wp_parse_args( [
            'title_tag' => 'h3',
            'components' => get_theme_mod( 'single_related_components', [
                'thumbnail', 'title', 'date',
            ]),
            'thumbnail_position' => 'left',
        ], fox56_default_args() );
        $thumbnail = get_theme_mod( 'single_related_thumbnail', '' );
        if ( $thumbnail ) {
            $args[ 'thumbnail' ] = $thumbnail;
            if ( 'custom' == $thumbnail ) {
                $args[ 'thumbnail_custom' ] = get_theme_mod( 'single_related_thumbnail_custom', [] );
            }
        }
        $layout = get_theme_mod( 'single_related_layout', 'grid-3' );
        
    switch( $layout ) {
        case 'grid-2':
            $args['layout'] = 'grid';
            $args['column'] = [ 'desktop' => 2, 'tablet' => 2, 'mobile' => 1 ];
            fox56_blog_grid( $query, $args );
        break;

        case 'grid-3':
            $args['layout'] = 'grid';
            $args['column'] = [ 'desktop' => 3, 'tablet' => 3, 'mobile' => 1 ];
            fox56_blog_grid( $query, $args );
        break;

        case 'grid-4':
            $args['layout'] = 'grid';
            $args['column'] = [ 'desktop' => 4, 'tablet' => 2, 'mobile' => 1 ];
            fox56_blog_grid( $query, $args );
        break;

        case 'list':
            $args['layout'] = 'list';
            $args['column'] = [ 'desktop' => 1, 'tablet' => 1, 'mobile' => 1 ];
            fox56_blog_list( $query, $args );
        break;
    }
    wp_reset_query();
}

/* BOTTOM POSTS
=============================================================== */
function fox56_bottom_posts() {
    ?>
    <div class="single56__bottom_posts"><?php fox56_bottom_posts_inner(); ?></div>
    <?php
}
function fox56_bottom_posts_inner() {
    /* ---------------------- query args */
    $query = fox56_related_query([
        'number' => get_theme_mod( 'single_bottom_posts_number', 5 ),
        'source' => get_theme_mod( 'single_bottom_posts_source', 'category' ),
        'orderby' => get_theme_mod( 'single_bottom_posts_orderby', 'date' ),
        'order' => get_theme_mod( 'single_bottom_posts_order', 'DESC' ),
        'exclude_categories' => get_theme_mod( 'single_bottom_posts_exclude_categories', '' ),
    ]);
    $exclude_categories = get_theme_mod( 'single_bottom_posts_exclude_categories', '' );
    if ( ! is_array( $exclude_categories)){
        $exclude_categories = [];
    }

    if ( ! $query || ! $query->have_posts() ) {
        wp_reset_query();
        return;
    }

    /* ---------------------- heading */
    $source = get_theme_mod( 'single_bottom_posts_source', 'category' );
    $name = '';
    if ( 'author' == $source ) {
        $name = get_the_author();
    } elseif ( 'tag' == $source ) {
        $name = esc_html__( 'Same Tags', 'wi' );
    } elseif ( 'date' == $source ) {
        $name = esc_html__( 'Blog', 'wi' );
    } elseif ( 'featured' == $source ) {
        $name = esc_html__( 'Featured Posts', 'wi' );
    // category by default    
    } else {
        $terms = wp_get_post_terms( get_the_ID(), 'category', array( 'fields' => 'ids' ) );
        if ( ! $terms ) {
            return;
        }
        $cat = fox56_primary_cat( $exclude_categories );
        $name = get_cat_name( $cat );
    }
    $heading = fox_word( 'latest' );
    if ( $heading ) { ?>
    <h2 class="single56__heading"><span><?php printf( $heading, $name ); ?></span></h2>
    <?php }

    $args = wp_parse_args( [
        'title_tag' => 'h3',
        'components' => get_theme_mod( 'single_bottom_posts_components', [
            'thumbnail', 'title', 'excerpt',
        ]),
        'layout' => 'grid',
        'column' => [ 'desktop' => 5, 'tablet' => 3, 'mobile' => 1 ],
    ], fox56_default_args() );
    $thumbnail = get_theme_mod( 'single_bottom_posts_thumbnail', '' );
    if ( $thumbnail ) {
        $args[ 'thumbnail' ] = $thumbnail;
        if ( 'custom' == $thumbnail ) {
            $args[ 'thumbnail_custom' ] = get_theme_mod( 'single_bottom_posts_thumbnail_custom', [] );
        }
    }
    fox56_blog_grid( $query, $args );
    wp_reset_query();
}

/* TAGS
=============================================================== */
function fox56_single_tags( $args = [] ) {
    $tags = get_the_tag_list( '<ul><li>','</li><li>','</li></ul>' );
    if ( ! $tags ) return;
    
    $cl = [ 'single-tags', 'entry-tags', 'post-tags', 'tags56', 'single56__part', 'single56__tags' ];
    
    /* ------------------------ align */
    $align = get_theme_mod( 'tags_align', 'left' );
    if ( $align ) {
        $cl[] = 'align-' . $align;
    }
    
    /* ------------------------ label */
    $tag_label = trim( strval( get_theme_mod( 'tags_label' ) ) );
    ?>
    <div class="<?php echo esc_attr( join( ' ', $cl ) ); ?>">

        <?php if ( ! empty( $tag_label) ) { ?>
        <h3 class="single56__heading tag-label">
            <span><?php echo $tag_label; ?></span>
        </h3>
        <?php } ?>

        <div class="terms56">
            <?php echo $tags; ?>
        </div><!-- .terms56 -->

    </div><!-- .single-tags -->
    <?php
}

/* AUTHOR BOX
=============================================================== */
function fox56_authorbox( $args = [] ) { ?>
    <div class="authorboxes56 single56__part single56__authorbox"><?php echo fox56_authorbox_inner(); ?></div>
    <?php
}
function fox56_authorbox_inner( $args = [] ) {
    ob_start();
    if ( function_exists( 'get_coauthors' ) ) {
        $authors = get_coauthors();
    } else {
        $authors = [ get_userdata( get_the_author_meta( 'ID' ) ) ];
    }
    
    foreach ( $authors as $user ) {

        $cl = [ 'authorbox56' ];

        /* ---------------- style */
        $style = get_theme_mod( 'authorbox_style', 'simple' );
        if ( 'box' != $style ) {
            $style = 'simple';
        }
        $cl[] = 'authorbox56--' . $style;

        /* ---------------- width */
        $cl[] = 'authorbox56--' . get_theme_mod( 'authorbox_width', 'full' );
        
        /* ---------------- ava shape */
        $cl[] = 'authorbox56--avatar-' . get_theme_mod( 'authorbox_avatar_shape', 'circle' );

        /* ---------------- link */
        $link = get_author_posts_url( $user->ID, $user->user_nicename );

        /* ---------------- tabs */
        $tabs = ( 'box' == $style );
        if ( $tabs ) {
            $cl[] = 'has-tabs';
        }
        
        $is_guest_author = get_userdata( $user->ID );
        $is_guest_author = $is_guest_author === false;
        if ( $is_guest_author ) {
            $name = $user->display_name;
            $desc = $user->description;
        } else {
            $name = get_the_author_meta( 'display_name', $user->ID );
            $desc = get_the_author_meta( 'description', $user->ID );
        }
        $desc = wpautop( do_shortcode( $desc ) );
        ?>
<div class="<?php echo esc_attr( join( ' ', $cl ) ); ?>">
    <div class="authorbox56__inner">
        <a href="<?php echo esc_attr( $link ); ?>" class="authorbox56__avatar">
            <?php echo get_avatar( $user->ID, 300 ); ?>
        </a>
        <div class="authorbox56__text">
            <?php if ( $tabs ) { ?>
            <div class="authorbox56__tabs font-heading">
                <a data-tab="author" class="active"><?php echo $name; ?></a>
                <a data-tab="latest"><?php echo fox_word( 'latest_posts' );?></a>
            </div>
            <?php } ?>
            <div class="authorbox56__content active" data-tab="author">
                <?php if ( ! $tabs ) { ?>
                <h3 class="authorbox56__name">
                    <a href="<?php echo $link; ?>"><?php echo $name; ?></a>
                </h3>
                <?php } ?>

                <?php if ( $desc ) { ?>
                <div class="authorbox56__description">
                    <?php echo $desc; ?>
                </div>
                <?php } ?>

                <?php 
                echo fox56_user_social([ 'user' => $user ]); ?>

            </div>

            <?php if ( $tabs ) {
                $args = array(
                    'posts_per_page'    => 4,
                    'author_name'       => $user->user_nicename, // use this instead of author ID for co-authors plus plugin
                    'no_found_rows'     => true, // no need for pagination
                );
                $same_author_query = new WP_QUery ( $args );
            if ( $same_author_query->have_posts() ) { ?>
            <div class="authorbox56__content authorbox56__latest" data-tab="latest">
                <ol>
                    <?php while ( $same_author_query->have_posts() ) { $same_author_query->the_post(); ?>
                    <li>
                        <a href="<?php the_permalink();?>"><?php the_title();?></a>
                    </li>
                    <?php } ?>
                </ol>
                <a class="btn56 btn56--fill btn56--tiny viewall" href="<?php echo get_author_posts_url( $user->ID, $user->user_nicename ); ?>" rel="author"><?php echo fox_word( 'viewall' ); ?></a>
            </div>
            <?php } // if have posts
            wp_reset_query();
            } // if tabs ?>
        </div><!-- authorbox56__text -->
    </div><!-- authorbox56__inner -->
</div>
<?php
    }
    return ob_get_clean();
}

function fox56_user_social( $args = [] ) {
    $user = isset( $args['user'] ) ? $args['user'] : false;
    if ( ! $user || is_wp_error( $user ) ) {
        return;
    }
    $icons = [
        'facebook',
        'youtube',
        'twitter',
        'instagram',
        'tiktok',
        'pinterest',
        'linkedin',
        'tumblr',
        'snapchat',
        'vimeo',
        'soundcloud',
        'flickr',
        'vkontakte',
        'spotify',
        'reddit',
        'whatsapp',
        'wechat',
        'weibo',
        'telegram',
    ];
    $icon_map = [
        'weibo' => 'sina-weibo',
        'vkontakte' => 'vk',
    ];
    $ul = [];
    foreach ( $icons as $icon ) {
        $ic = isset( $icon_map[$icon] ) ? $icon_map[$icon] : $icon;
        $url = trim( strval( get_user_meta( $user->ID, $icon, true ) ) );
        if ( ! $url ) {
            continue;
        }
        $li = '<li><a href="' . esc_url( $url ). '" target="_blank" role="tooltip" aria-label="' . ucfirst( $icon ). '" data-microtip-position="top"><i class="ic56-' . esc_attr( $ic ) . '"></i></a></li>';
        $ul[] = $li;
    }
    $url = isset( $user->user_url ) ? $user->user_url : '';
    if ( $url ) {
        $li = '<li><a href="' . esc_url( $url ) . '" target="_blank" role="tooltip" aria-label="Website" data-microtip-position="top"><i class="ic56-link1"></i></a></li>';
        $ul[] = $li;
    }

    if ( empty( $ul )) {
        return;
    }
    $ul = join( "\n", $ul );
    return '<div class="fox56-social-list"><ul>' . $ul . '</ul></div>';
}

/* SINGLE NAV
=============================================================== */
function fox56_single_nav( $args = [] ) {
    ?>
    <div class="single56__part single56__nav">
        <?php fox56_single_nav_inner(); ?>
    </div>
    <?php
}

function fox56_single_nav_inner() {

    /* ------------------------- style */
    $style = get_theme_mod( 'single_nav_style', 'advanced' );
    if ( ! in_array( $style, [ 'minimal-1', 'minimal-2', 'minimal-3', 'simple', 'simple-2', 'advanced' ] ) ) {
        $style = 'advanced';
    }
    $cl = [ 'singlenav56', 'singlenav56--' . $style ];

    $same_term = get_theme_mod( 'single_nav_same_term', false );
    $core_style = str_replace( [ '-1', '-2', '-3' ], '', $style );
    $cl[] = 'singlenav56--' . $core_style;

    /* ------------------------- advanced */
    if ( 'advanced' == $style ) {
        $get_posts = [
            'prev' => get_previous_post( $same_term ),
            'next' => get_next_post( $same_term ),  
        ];
        $labels = [
            'prev' => fox_word( 'previous_story' ),
            'next' => fox_word( 'next_story' ),
        ];
        $column = 0;
        if ( $get_posts['prev'] ) { $column++; }
        if ( $get_posts['next'] ) { $column++; }
        if ( ! $column ) {
            return;
        }
        $cl[] = 'singlenav56--' . $column . 'cols';
    }

    ?>
<div class="<?php echo esc_attr( join( ' ', $cl )); ?>">

    <?php if ( 'advanced' != $style ) { echo '<div class="container">'; } ?>
    
    <?php switch( $core_style ) {

        /* ------------------------- minimal - only NEXT/PREV */
        case 'minimal' :
            the_post_navigation( [

                // next
                'next_text' => '<span class="font-heading">' . fox_word( 'next_story' ) . '</span>' . '<i class="ic56-chevron-thin-right"></i>',

                // prev
                'prev_text' => '<i class="ic56-chevron-thin-left"></i>' . '<span class="font-heading">' . fox_word( 'previous_story' ) . '</span>',

                'in_same_term' => $same_term,
            ] );
        break;

        /* ------------------------- simple - NEXT/PREV + post title */
        case 'simple' :
            the_post_navigation( [
                // next
                'next_text' => '<span class="meta-nav" aria-hidden="true">' . fox_word( 'next_story' ) . '<i class="ic56-caret-right"></i></span> ' .
                    '<span class="screen-reader-text">' . esc_html__( 'Next post:', 'wi' ) . '</span> ' .
                    '<h4>%title</h4>',

                // prev
                'prev_text' => '<span class="meta-nav" aria-hidden="true"><i class="ic56-caret-left"></i>' . fox_word( 'previous_story' ) . '</span> ' .
                    '<span class="screen-reader-text">' . esc_html__( 'Previous post:', 'wi' ) . '</span> ' .
                    '<h4>%title</h4>',
                'in_same_term' => $same_term,
            ] );
        break;

        /* ------------------------- advanced - having thumbnail */
        case 'advanced' :
            
            foreach ( $get_posts as $pos => $p ) {
                if ( ! $p ) {
                    continue;
                }
                ?>
                <div class="singlenav56__post singlenav56__post--<?php echo $pos; ?>">
                    <div class="singlenav56__post__bg">
                        <?php echo get_the_post_thumbnail( $p, 'large' ); ?>
                    </div>
                    <div class="singlenav56__post__overlay"></div>
                    <div class="singlenav56__post__text">
                        <div class=".singlenav56__post__text__inner">
                            <span><?php echo $labels[$pos]; ?></span>
                            <h4><?php echo get_the_title( $p ); ?></h4>
                        </div>
                    </div>
                    <a href="<?php echo get_permalink($p); ?>"></a>
                </div>
                <?php
            }

        break;
    } ?>

    <?php if ( 'advanced' != $style ) { echo '</div>'; } ?>

</div>
    <?php
}

/* COMMENTS
=============================================================== */
function fox56_comments( $args = [] ) {
    if ( comments_open() || get_comments_number() ) {
        comments_template();
    }
}

/* 
 * Comment Nav
------------------------ */
function fox56_comment_nav( $pos ) {
    
    if ( get_comment_pages_count() > 1 && get_theme_mod( 'page_comments' ) ) : // Are there comments to navigate through? ?>

    <nav id="comment-nav-<?php echo esc_attr( $pos ); ?>" class="navigation comment-navigation" role="navigation">
        <h3 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'wi' ); ?></h3>
        <div class="nav-links">

            <div class="nav-previous"><?php previous_comments_link( esc_html__( '&larr; Older Comments', 'wi' ) ); ?></div>
            <div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments &rarr;', 'wi' ) ); ?></div>

        </div><!-- .nav-links -->
    </nav><!-- #comment-nav-# -->

    <?php endif; // Check for comment navigation.

}

/* VIEW COUNT
=============================================================== */
function fox56_get_view( $post_id = null ) {
    if ( ! function_exists( 'pvc_get_post_views' ) ) return null;
    if ( ! $post_id ) {
        global $post;
        $post_id =  $post->ID;
    }
    return pvc_get_post_views( $post_id );
}
function fox56_meta_view( $args = [] ) {
    $cl = [ 'meta56__item', 'meta56__view' ];
    $count = fox56_get_view();
    if ( is_null( $count ) ) {
        return;
    }
    ?>
    <div class="<?php echo esc_attr(join(' ', $cl)); ?>">
        <?php printf( fox_word( 'views' ), fox_number( $count ) ); ?>
    </div>
<?php }

/* FORMAT INDICATOR
=============================================================== */
if ( ! function_exists( 'fox56_get_format_indicator' ) ) :
function fox56_get_format_indicator() {
    $format = get_post_format();
    if ( ! $format ) {
        return;
    }
    if ( 'video' == $format ) {
        $style = get_theme_mod( 'video_indicator_style', 'outline' );
        return '<span class="format-icon format-icon--video format-icon--video--' . $style . '"><i class="ic56-play3"></i></span>';
    }
    if ( 'audio' == $format ) {
        return '<span class="format-icon format-icon--audio"><i class="ic56-headphones"></i></span>';
    }
    if ( 'gallery' == $format ) {
        return '<span class="format-icon format-icon--gallery"><i class="ic56-images"></i></span>';
    }
    if ( 'link' == $format ) {
        return '<span class="format-icon format-icon--link"><i class="ic56-link1"></i></span>';
    }
}
endif;

/* COMMENT LINK
=============================================================== */
function fox56_meta_comment_link( $args = [] ) {
    $cl = [ 'meta56__item', 'meta56__comment' ];
    $icon = '<i class="ic56-chat_bubble_outline"></i>';
    ?>
    <div class="<?php echo esc_attr( join( ' ', $cl )); ?>">
        <?php comments_popup_link( 
            $icon,
            '<span class="comment-num">1</span>' . $icon, 
            '<span class="comment-num">%</span>' . $icon,
            'comment-link',
            '<i class="ic56-chat_bubble_outline off"></i>'
        ); ?>
    </div>
    <?php
}

/* SUBTITLE
=============================================================== */
function fox56_subtitle( $args = [] ) {
    if ( function_exists( 'fox56_childtheme_subtitle' ) ) {
        fox56_childtheme_subtitle();
        return;
    }
    $display = get_theme_mod( 'subtitle_display', 'subtitle' );
    if ( 'excerpt' == $display ) {
        $subtitle = get_the_excerpt();
    } else {
        $subtitle = trim( strval( get_post_meta( get_the_ID(), '_wi_subtitle', true ) ) );
    }
    if ( empty( $subtitle) ) {
        return;
    } ?>
    <div class="post-subtitle single56__subtitle component56"><?php echo do_shortcode( $subtitle ); ?></div>
<?php }

/* SHARE
=============================================================== */
function fox56_share( $args = [] ) {
    $cl = [ 'component56', 'component56--share', 'share56__outer' ];
    ?>
    <div class="<?php echo esc_attr( join( ' ', $cl ) ); ?>">
        <?php echo fox56_share_inner(); ?>
    </div>
<?php
}
if ( ! function_exists( 'fox56_share_inner' ) ) :
function fox56_share_inner() {
    $cl = [ 'share56' ];
    ob_start();
    $elements = get_theme_mod( 'share_elements', [ 'facebook', 'twitter', 'pinterest', 'whatsapp', 'email' ] );
    $url = get_permalink();
    $via = get_theme_mod( 'twitter_username', 'withemes' );
    $title = esc_html( get_the_title() );

    /* --------------------     stretch */
    $stretch = get_theme_mod( 'share_stretch', 'inline' );
    $cl[] = 'share56--' . $stretch;

    /* --------------------     align */
    if ( 'inline' == $stretch ) {
        $share_align = get_theme_mod( 'share_align', 'left' );
        $cl[] = 'align-' . $share_align;
    }

    /* --------------------     custom color */
    $color_scheme = get_theme_mod( 'share_color_scheme', 'brand' );
    $cl[] = 'share56--' . $color_scheme;
    ?>
    <div class="<?php echo esc_attr( join( ' ', $cl ) ); ?>">
        <?php if ( 'inline' == $stretch && $label = get_theme_mod( 'share_label' ) ) { ?>
            <span class="share56__label"><?php echo esc_html( $label ); ?></span>
        <?php } ?>
        <ul>
            <?php foreach ( $elements as $ele ) { $href = false; ?>
                <?php switch( $ele ) {
                    /* ------------------ facebook */
                    case 'facebook' :
                        $href = 'https://www.facebook.com/sharer/sharer.php?u=' . urlencode( $url );
                        $icon = 'ic56-facebook';
                        $label = 'Facebook';
                    break;

                    /* ------------------ twitter */
                    case 'twitter':
                        $href = 'https://x.com/intent/tweet?url=' . urlencode($url) .'&amp;text=' . urlencode( html_entity_decode( $title ) );
                        if ( $via ) {
                            $href .= '&amp;via=' . urlencode( $via );
                        }
                        $icon = 'ic56-x-twitter';
                        $label = 'X';
                    break;

                    /* ------------------ telegram */
                    case 'telegram' :
                        $href = 't.me/share/url?url=' . urlencode( $url ) . '&text='.rawurlencode( $title );
                        $icon = 'ic56-telegram';
                        $label = 'Telegram';
                    break;

                    /* ------------------ pinterest */
                    case 'pinterest':
                        $href = 'https://pinterest.com/pin/create/button/?url=' . urlencode($url) . '&amp;description=' . urlencode( html_entity_decode( $title ) );
                        $icon = 'ic56-pinterest';
                        $label = 'Pinterest';
                    break;

                    /* ------------------ linkedin */
                    case 'linkedin':
                        $href = 'https://www.linkedin.com/shareArticle?mini=true&url=' . urlencode( $url ) . '&amp;title=' . urlencode( html_entity_decode( $title ) );
                        $icon = 'ic56-linkedin';
                        $label = 'Linkedin';
                    break;

                    /* ------------------ whatsapp */
                    case 'whatsapp':
                        $href = 'https://api.whatsapp.com/send?phone=&text=' . urlencode( $url );
                        $icon = 'ic56-whatsapp';
                        $label = 'Whatsapp';
                    break;

                    /* ------------------ reddit */
                    case 'reddit':
                        $href = 'https://www.reddit.com/submit?url=' . urlencode( $url ) . '&title=' . urlencode( html_entity_decode( $title ) );
                        $icon = 'ic56-reddit';
                        $label = 'Reddit';
                    break;

                    /* ------------------ email */
                    case 'email':
                        $href = 'mailto:?subject=' . rawurlencode( html_entity_decode( $title ) )  . '&amp;body=' . rawurlencode($url);
                        $icon = 'ic56-envelope';
                        $label = 'Email';
                    break;
                    ?>
            <?php }
            if ( ! $href ) { continue; }
            ?>
            <li class="li-<?php echo $ele; ?>">
                <a href="<?php echo esc_url( $href ); ?>" data-share="<?php echo esc_attr( $ele ); ?>" aria-label="<?php echo esc_attr( $label ); ?>" role="tooltip" data-microtip-position="top">
                    <i class="<?php echo esc_attr( $icon ); ?>"></i>
                    <span><?php echo esc_html( $label ); ?></span>
                    
                </a>
            </li>
            <?php } // foreach ?>
        </ul>
    </div>
<?php 
    return ob_get_clean();
}
endif;

/* SPONSOR
=============================================================== */
function fox56_sponsor() {
    if ( 'true' != get_post_meta( get_the_ID(), '_wi_sponsored', true ) ) {
        return;
    }
    
    $open = $close = '';
    $url = get_post_meta( get_the_ID(), '_wi_sponsor_url', true );
    if ( $url ) {
        $open = '<a href="' . esc_url( $url ) . '" target="_blank">';
        $close = '</a>';
    }
    $name = get_post_meta( get_the_ID(), '_wi_sponsor_name', true );
    $label = get_post_meta( get_the_ID(), '_wi_sponsor_label', true );
    if ( ! $label ) {
        $label = fox_word( 'sponsored' );
    }
    ?>

<div class="single56__sponsor">
    
    <?php if ( $label ) { ?>
    <div class="single56__sponsor__label"><?php echo $label; ?></div>
    <?php } ?>
    
    <div class="single56__sponsor__meta">
        
        <?php $img_id = get_post_meta( get_the_ID(), '_wi_sponsor_image', true ); if ( $img_id ) {
            $img = wp_get_attachment_image( $img_id, 'medium' );
            $sponsor_image_style = '';
        if ( $sponsor_image_width = get_post_meta( get_the_ID(), '_wi_sponsor_image_width', true ) )  {
            if ( is_numeric( $sponsor_image_width ) ) $sponsor_image_width .= 'px';
            $sponsor_image_style = ' style="width:' . esc_attr( $sponsor_image_width ). '"';
        }
        ?>
        <div class="single56__sponsor__image"<?php echo $sponsor_image_style; ?>>
            <?php echo $open; ?>
            <?php echo $img; ?>
            <?php echo $close; ?>
        </div>
        <?php } ?>
        
        <?php if ( $name ) { ?>
        <span class="single56__sponsor__name"><?php echo $open . $name . $close ; ?></span>
        <?php } ?>

    </div>

</div><!-- .single56__sponsor -->
<?php }

/* REVIEW
=============================================================== */
function fox56_get_review_score_number() {
    return get_post_meta( get_the_ID(), '_wi_review_average', true );
}

function fox56_get_review_score() {
    $average = fox56_get_review_score_number();
    return number_format( ( float ) $average, 1, '.', '' );
}

function fox56_review() {

    $review = get_post_meta( get_the_ID(), '_wi_review', true ); 
    if ( ! $review || ! is_array( $review ) ) {
        return;
    }

    /* ------------------------     items */
    $ul = [];
    foreach ( $review as $item ) {
        if ( ! isset( $item[ 'criterion' ] ) || ! isset( $item[ 'score' ] ) ){
            continue;
        }
        if ( ! $item['criterion'] ) {
            continue;
        }
        if ( ! $item['score']) {
            continue;
        }
        $li = '<div class="review-criterion review56__item__criterion">' . $item[ 'criterion' ] . '</div>';
        $li .= '<div class="review-score review56__item__score">' . $item[ 'score' ] . '<span class="unit">/10</span></div>';
        $li = "<div class='review-item review56__item'>{$li}</div>";
        $ul[] = $li;
    }
    if ( empty( $ul) ) {
        return;
    }

    /* ------------------------     average */
    $average = fox56_get_review_score_number();
    if ( $average && is_numeric( $average )) {
        $li = '<div class="review-criterion review56__item__criterion">' . fox_word( 'overall' ) . '</div>';
        $li .= '<div class="review-score review56__item__score">' . fox56_get_review_score() . '<span class="unit">/10</span></div>';
        $li = '<div class="review-item overall review56__item">' . $li . '</div>';
        $ul[] = $li;
    }
    ?>

<div class="review56">

    <?php /* ------------------------     heading */ ?>
    <h2 id="review-heading" class="review56__heading"><?php echo fox_word( 'review' ); ?></h2>

    <?php /* ------------------------     main */ ?>
    <div class="review56__main" id="review">
        <?php echo join( "\n", $ul ); ?>
    </div>
    
    <?php /* ------------------------     text */ ?>
    <?php if ( $review_text = get_post_meta( get_the_ID(), '_wi_review_text', true ) ) { ?>
    <div class="review-text review56__text">
        <div class="review-text-inner review56__text__inner">
            <?php echo do_shortcode( $review_text ); ?>
        </div>
    </div>
    <?php } ?>
    
    <?php /* ------------------------     buttons */ ?>
    <?php 
    $btn1 = get_post_meta( get_the_ID(), '_wi_review_btn1_url', true );
    $btn1_text = trim( get_post_meta( get_the_ID(), '_wi_review_btn1_text', true ) );
    if ( ! $btn1_text ) { $btn1_text = 'Click Me'; }
    $btn2 = get_post_meta( get_the_ID(), '_wi_review_btn2_url', true );
    $btn2_text = trim( get_post_meta( get_the_ID(), '_wi_review_btn2_text', true ) ); 
    if ( ! $btn2_text ) { $btn2_text = 'Click Me'; }
    if ( $btn1 || $btn2 ) {
    ?>
    <div class="review-buttons review56__buttons">
        
        <?php if ( $btn1 ) { ?>
        <a href="<?php echo esc_url( $btn1 ); ?>" target="_blank" class="wi-btn fox-btn btn-fill btn-small btn-1 btn56 btn56--fill btn56--small"><?php echo $btn1_text; ?></a>
        <?php } ?>
        
        <?php if ( $btn2 ) { ?>
        <a href="<?php echo esc_url( $btn2 ); ?>" target="_blank" class="wi-btn fox-btn btn-fill btn-small btn-2 btn56 btn56--fill btn56--small"><?php echo $btn2_text; ?></a>
        <?php } ?>
    
    </div><!-- .review-buttons -->
    
    <?php } // if btn ?>
    
</div>
    <?php
}

/* PAGINATION
=============================================================== */
function fox56_pagination( $query = false, $args = [] ) {

    if ( ! $query ) {
        global $wp_query;
        $query = $wp_query;
    }

    $prev_label = fox_word( 'previous' );
    $next_label = fox_word( 'next' );
    
    $big_number = 9999; // need an unlikely integer
    $paged = get_query_var( 'paged' );

    // var_dump( $query );

    $pagination = paginate_links( array(
        /* essential */
		// 'base' => str_replace( $big_number, '%#%', esc_url( get_pagenum_link( $big_number ) ) ),
		// 'format' => '?paged=%#%',
		'current' => max( 1, $paged ),
		'total' => $query->max_num_pages,

        /* design part */
        'type'			=> 'plain',
		'before_page_number'	=>	'<span>',
		'after_page_number'	=>	'</span>',
		'prev_text'    => '<span>' . $prev_label . '</span>',
		'next_text'    => '<span>' . $next_label . '</span>',
	));

    return '<div class="pagination56">' . $pagination . '</div>';

}

/* BUTTON
=============================================================== */
function fox56_btn( $args = [], $echo = true ) {
    $cl = [];
    extract( wp_parse_args( $args, [
        'text' => 'Click Me',
        'url' => '',
        'target' => '',
        'icon' => '',
        'style' => '',
        'border_width' => '',
        'size' => '',
        
        'align' => '',
        'block' => '',
        'shape' => '', // legacy
        'border_radius' => '',
        
        // custom attr
        'attr' => '',
        'extra_class' => '',
        
        // color
        'text_color' => '',
        'bg_color' => '',
        'border_color' => '',
        'text_color_hover' => '',
        'bg_color_hover' => '',
        'border_color_hover' => '',
        
        'id' => '',
        
    ] ) );
    
    if ( ! $text && ! $icon ) {
        return;
    }
    $cl = [ 'btn56' ];
    $outer_cl = [ 'button56' ];
    $attrs = [];

    /* -----------------        text */
    $text_html = '<span class="btn-main-text">' . esc_html__( $text ) . '</span>';
    
    /* -----------------        custom attrs */
    if ( $attr ) {
        $attrs[] = $attr;
    }
    
    /* -----------------        extra class */
    if ( $extra_class ) {
        $cl[] = $extra_class;
    }
    
    /* -----------------        style */
    if ( ! in_array( $style, [ 'primary', 'black', 'outline', 'fill' ] ) ) {
        $style = 'black';
    }
    $cl[] = 'btn56--' . $style;
    
    /* -----------------        size */
    if ( ! in_array( $size, [ 'tiny', 'small', 'normal', 'medium', 'large' ] ) ) {
        $size = 'normal';
    }
    $cl[] = 'btn56--' . $size;
    
    /* -----------------        icon */
    // if we use icon here, enqueue font awesome/feather right here, no problem
    $icon_html = '';
    if ( $icon ) {
        
        $icon = trim( strtolower( $icon ) );
        if ( 'feather-' == substr( $icon, 0, 8 ) ) {
            $ic = $icon;
            wp_enqueue_style( 'fox-feather' );
        } elseif ( 'fa fa-' == substr( $icon, 0, 6 ) || 'fab fa-' == substr( $icon, 0, 7 ) ) {
            $ic = $icon;
            wp_enqueue_style( 'fox-fontawesome' );
        } else {
            $ic = 'fa fa-' . $icon;
            wp_enqueue_style( 'fox-fontawesome' );
        }
        $icon_html = '<i class="' . esc_attr( $ic ) . '"></i>';
        
    }
    
    /* -----------------        target */
    if ( '_blank' != $target ) {
        $target = '_self';
    }
    $attrs[] = 'target="' . $target . '"';
    
    /* -----------------        align */
    if ( 'left' == $align || 'center' == $align || 'right' == $align ) {
        $outer_cl[] = 'button56--align align-' . $align;
    } else {
        $outer_cl[] = 'button56--inline';
    }
    
    /* -----------------        block */
    if ( 'full' == $block || 'half' == $block || 'third' == $block ) {
        $outer_cl[] = 'button56--block';
        $outer_cl[] = 'button56--block-' . $block;
    }

    /* -----------------        url */
    if ( $url ) {
        $attrs[] = 'href="' . esc_attr( $url ) . '"';
    }
    
    /* -----------------        class */
    $attrs[] = 'class="' . esc_attr( join( ' ', $cl ) ) . '"';
    
    /* -----------------        id */
    global $fox_btn_index;
    if ( ! isset( $fox_btn_index ) || ! $fox_btn_index ) {
        $fox_btn_index = 0;
    }
    $fox_btn_index += 1;
    if ( ! $id ) {
        $id = uniqid( 'button-id-' ) . '-' . $fox_btn_index;
    }
    $attrs[] = 'id="' . esc_attr( $id ) . '"';
    
    /* -----------------        custom color */
    $css = [];
    if ( $text_color ) {
        $css[] = 'color:' . $text_color;
    }
    if ( $bg_color ) {
        $css[] = 'background:' . $bg_color;
    }
    if ( $border_color ) {
        $css[] = 'border-color:' . $border_color;
    }
    
    /* -----------------        hover */
    $hover_css = [];
    if ( $text_color_hover ) {
        $hover_css[] = 'color:' . $text_color_hover;
    }
    if ( $bg_color_hover ) {
        $hover_css[] = 'background:' . $bg_color_hover;
    }
    if ( $border_color_hover ) {
        $hover_css[] = 'border-color:' . $border_color_hover;
    }

    /* -----------------        shape + border radius */
    if ( 'pill' == $shape && '' === $border_radius ) {
        $border_radius = 30;
    } elseif ( 'round' == $shape && '' === $border_radius ) {
        $border_radius = 4;
    } elseif ( '' === $border_radius ) {
        $border_radius = 0;
    }
    if ( ! $border_radius ) {
        $border_radius = 0;
    }
    if ( is_numeric ($border_radius )) {
        $border_radius .= 'px';
    }
    $css[] = 'border-radius:' . $border_radius;
    
    /* -----------------        border width */
    if ( '' !== $border_width ) {
        if ( is_numeric( $border_width ) ) {
            $border_width .= 'px';
        }
        $css[] = 'border-width:' . $border_width;
    }
    
    /* -----------------        css */
    $style = [];
    if ( $css ) $style[] = '#' . $id . '{' . join( ';', $css ). '}';
    if ( $hover_css ) $style[] = '#' . $id . ':hover{' . join( ';', $hover_css ) . '}';
    
    ob_start();
    if ( $style ) {
        echo '<style type="text/css">';
        echo join( '', $style );
        echo '</style>';
    }
    
    ?>

<div class="<?php echo esc_attr( join( ' ', $outer_cl ) ); ?>">
    <a <?php echo join( ' ', $attrs ); ?>><?php echo $text_html . $icon_html; ?></a>
</div>

<?php
    $output = ob_get_clean();
    if( !$echo ) return $output;

    echo $output;
}

/* AD
=============================================================== */
function fox56_ad( $pos ) {
    $cl = [ 'ad56', "ad56--{$pos}" ];
    $ad_inner = fox56_ad_inner( $pos );
    if ( empty( $ad_inner ) ) {
        return;
    } 
    ?>
    <div class="<?php echo esc_attr( join( ' ', $cl ) ); ?>">
        <?php echo $ad_inner; ?>
    </div>
    <?php
}
function fox56_ad_inner( $pos ) {
    
    $prefix = "ad_{$pos}_";
    $code = trim( strval( get_theme_mod( "{$prefix}code" ) ) );
    if ( $code ) {
        return '<div class="ad56__content ad56__content--code">' . do_shortcode( $code ) . '</div>';
    }

    $imgs = [];

    $url = get_theme_mod( "{$prefix}url" );
    $url = trim( strval( $url ) );
    if ( $url ) {
        $a = '<a href="' . esc_url( $url ). '" target="_blank">';
        $a_close = '</a>';
    } else {
        $a = ''; $a_close = '';
    }

    $mobile = get_theme_mod( "{$prefix}mobile" );
    $tablet = get_theme_mod( "{$prefix}tablet" );
    $image = get_theme_mod( "{$prefix}image" );

    $imgs = [];
    if ( $mobile ) {
        $imgs[] = wp_get_attachment_image( $mobile, 'full', false, [ 'class' => 'banner56--mobile' ]);
    }
    if ( $tablet ) {
        $imgs[] = wp_get_attachment_image( $tablet, 'full', false, [ 'class' => 'banner56--tablet' ]);
    }
    if ( $image ) {
        $imgs[] = wp_get_attachment_image( $image, 'full', false, [ 'class' => 'banner56--desktop' ]);
    }
    if ( empty( $imgs ) ) {
        return;
    }
    return '<div class="ad56__content ad56__content--banner">' . $a . join( "\n", $imgs ) . $a_close . '</div>';

}

/* fox_word
=============================================================== */
if ( ! function_exists( 'fox_word' ) ) :
    function fox_word( $id = '' ) {
        
        $strings = fox_quick_translation_support();
        
        if ( ! isset( $strings[ $id ] ) ) return;
        
        $translation = get_theme_mod( 'translate', [] );
        if ( ! is_array( $translation) ) {
            $translation = [];
        }
        
        $get = isset( $translation[ $id ] ) ? $translation[ $id ] : '';
        
        if ( ! $get ) {
            $get = $strings[ $id ];
        }
        
        return $get;
        
    }
endif;

/**
 * Convert to bytes
 */
function fox56_convert_to_bytes( $value ) {
    $value = trim( $value );
    $unit = strtolower( $value[strlen( $value ) - 1] );
    $numericValue = (int)$value;
    switch($unit) {
        case 'g':
            $numericValue *= 1024;
        case 'm':
            $numericValue *= 1024;
        case 'k':
            $numericValue *= 1024;
    }

    return $numericValue;
}

/**
 * Compare server config on php.ini file
 * Return: 1 if $value1 > $value2, 0 if $value1 equal $value2, -1 if $value1 < $value2
 */
function fox56_compare_serverconfig( $value1, $value2 ) {
    $bytes1 = fox56_convert_to_bytes( $value1 );
    $bytes2 = fox56_convert_to_bytes( $value2 );

    if ($bytes1 > $bytes2) {
        return 1;
    } elseif ($bytes1 < $bytes2) {
        return -1;
    } else {
        return 0;
    }
}