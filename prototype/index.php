<html>
    <head>
        <title>Siller MMP1 Prototyp</title>
        <link rel="shortcut icon" type="image/x-icon" href="../assets/img/book.svg">
        <link rel="stylesheet" href="../assets/css/foundation_complete.css">
        <link rel="stylesheet" href="../assets/css/foundation-icons.css">
        <link rel="stylesheet" href="../assets/css/app.css">
        <script type="text/javascript" src="../assets/js/holder.js"></script>
        <!--facebook login-->
        <script>
            window.fbAsyncInit = function() {
                FB.init({
                    appId      : '694067674068772',
                    xfbml      : true,
                    version    : 'v2.5'
                });
            };

            (function(d, s, id){
                var js, fjs = d.getElementsByTagName(s)[0];
                if (d.getElementById(id)) {return;}
                js = d.createElement(s); js.id = id;
                js.src = "//connect.facebook.net/en_US/sdk.js";
                fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));

            function login() {
                FB.login(function(response){
                    // Handle the response object, like in statusChangeCallback() in our demo
                    // code.
                    alert(response)
                }, {scope: 'public_profile,email'});
            }
        </script>
    </head>
    <body>
        <div class="wrapper">
            <div class="app-container">
                <div class="top-bar">
                    <div class="row column">
                        <div class="top-bar-title">
                            <img src="../assets/img/book.svg" alt="app-icon" class="app-icon"/>
                            <strong>PartyGameBook</strong>
                        </div>
                        <div class="top-bar-left">
                            <ul data-responsive-menu="accordion" class="menu accordion-menu" role="tablist" aria-multiselectable="true" data-accordionmenu="1ox0y7-accordionmenu" data-responsivemenu="qpdu9h-responsivemenu">
                                <li role="menuitem"><a href="#">Alle</a></li>
                                <li role="menuitem"><a href="#">Tags</a></li>
                                <li role="menuitem"><a href="new_game.html">Neues Spiel hinzufügen</a></li>
                            </ul>
                        </div>
                        <div class="top-bar-right">
                            <ul class="menu">

                                <li><a href="#" class="button facebook" onclick="login()"><i class="fi-social-facebook"></i>mit Facebook anmelden</a></li>
                                <li><input type="search" placeholder="Spielenamen"></li>
                                <li><button type="button" class="button">Suche</button></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="row column">
                    <h3>Neu</h3>
                    <hr>
                </div>
                <div class="row">
                    <div class="small-3 column">
                        <article class="article-card">
                            <img src="holder.js/300x200">
                            <div class="card-content">
                                <h5>Shithead <small>von <a href="#">Thomas Siller</a></small></h5>
                                <p>If my answers frighten you then you should c...</p>
                                <p>
                                    <a href="#">weiter lesen</a>
                                </p>
                            </div>
                        </article>
                    </div>
                    <div class="small-3 column">
                        <article class="article-card">
                            <img src="holder.js/300x150">
                            <div class="card-content">
                                <p class="post-author">von <a href="#">Thomas Siller</a></p>
                                <h5>Shithead</h5>
                                <p>If my answers frighten you then you ...</p>
                                <p>
                                    <a href="#">weiter lesen</a>
                                </p>
                            </div>
                        </article>
                    </div>
                    <div class="small-3 column">
                        <article class="article-card">
                            <img src="holder.js/300x200">
                            <div class="card-content">
                                <p class="post-author">von <a href="#">Thomas Siller</a></p>
                                <h5>Shithead</h5>
                                <p>If my answers frighten you then you ...</p>
                                <p>
                                    <a href="#">weiter lesen</a>
                                </p>
                            </div>
                        </article>
                    </div>
                    <div class="small-3 column">
                        <article class="article-card">
                            <img src="holder.js/300x200">
                            <div class="card-content">
                                <p class="post-author">von <a href="#">Thomas Siller</a></p>
                                <h5>Shithead</h5>
                                <p>If my answers frighten you then you </p>
                                <p>
                                    <a href="#">weiter lesen ...</a>
                                </p>
                            </div>
                        </article>
                    </div>
                </div>
                <div class="row column">
                    <h3>Beliebt</h3>
                    <hr>
                </div>
                <div class="row column">
                    <h3>Zufällig</h3>
                    <hr>
                </div>
            </div>
            <div class="app-footer">
                <footer class="footer">
                    <div class="row column">
                        <div style="float: left">&copy; Thomas Siller mmt-b2015</div>
                        <div style="float: right">MMP 1 - PartyGameBook</div>
                    </div>
                </footer>
            </div>
        </div>
    </body>
</html>
