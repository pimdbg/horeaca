<?php
    class Pages extends Controller{
        public function home(){
            $this -> view('pages/home_test', array(
                'scripts'=>'
                    <script async src="https://platform.twitter.com/widgets.js" charset="utf-8" defer></script>',
                'meta'=>'
                    <title>'.SITENAME.'</title>
                    <meta name="robots" content="follow, index">
                    <meta name="description" content="Horeaca is een kleine brasserie vol met lekker, Bourgondisch eten.">
                    <link rel="canonical" href="'.ROOT.'pages/home">',
                'header'=>'
                    <header id="headerHome"></header>',
                'body'=>'
                    <main>
                        <section id="title">
                            <h1>'.SITENAME.'</h1>
                            <p>
                                <strong>Goed eten, fijne sfeer</strong>
                            </p>
                        </section>
                        <div class="aligned">
                            <section>
                                <section>
                                    <h2><a href="'.ROOT.'pages/menu">Menu</a></h2>
                                    <p>Zoek je gerecht nu al uit via onze online <strong>Menukaart</strong><br>
                                    <a href="'.ROOT.'pages/pdf" download>Download de menukaart</a>
                                    </p>
                                </section>
                                <section>
                                    <h2><a href="reservations">Reserveren</a></h2>
                                    <p>Horeaca heeft nu de mogelijkheid via de website te reserveren.<br>
                                    Dit kan makkelijk en snel gedaan worden via ons online formulier.<br>
                                    Maak nu een <a href="'.ROOT.'public/pages/reservations">online reservering</a></p>
                                </section>
                                <section>
                                    <h2><a href="contact">Contact</a></h2>
                                    <p>Vragen, opmerkingen of andere zaken?<br>
                                    Vind makkelijk de <a href="'.ROOT.'public/pages/contact#openingsSchedule">openingstijden</a>, contactgegevens of vul ons contactformulier in</p>
                                </section>
                            </section>
                            <section>
                                <a class="twitter-timeline" data-height="600" data-width="350" data-theme="light" href="https://twitter.com/TwitterDev?ref_src=twsrc%5Etfw">Tweets by TwitterDev</a>
                            </section>
                        </div>
                        <section class="gallery">
                            <img src="'.ROOT.'img/food_sandwich.min.jpg" alt="sandwich">
                            <img src="'.ROOT.'img/food_burger_fries.min.jpg" alt="burger with fries">
                            <img src="'.ROOT.'img/food_grill_cheese.min.jpg" alt="grilled cheese">
                        </section>
                    </main>'
            ));
        }
        public function reservations(){
            $this -> model('reserver');
            $messages=$this -> model -> getMessages();
            $this -> view('pages/home_test', array(
                'scripts'=>'
                    <link rel="stylesheet" type="text/css" href="'.ROOT.'css/style_form.css">
                    <script src="'.ROOT.'js/object_datepicker.js" defer></script>
                    <script src="'.ROOT.'js/object_selector.js" defer></script>',
                'meta'=>'
                    <title>Reserveren | '.SITENAME.'</title>
                    <meta name="robots" content="follow, index">
                    <meta name="description" content="Reserveer nu een tafel bij Horeaca, makkelijk en snel">
                    ',
                'header'=>'
                    <header id="headerReservations"></header>',
                'body'=>'
                    <main class="aligned">
                        <section>
                            <h1>Reserveren</h1>
                            <p>Maak een reservering door het formulier in te vullen</p>
                            '.$messages['success'].'
                            <form action="'.ROOT.'pages/reservations" method="post">
                                <label for="honorificMale">Dhr.</label>
                                <input type="radio" id="honorificMale" name="honorific" value="male" checked="checked">
                                <label for="honorificFemale">Mw.</label>
                                <input type="radio" id="honorificFemale" name="honorific" value="female"><br>
                                '.$messages['errors']['honorific'].'
                                <label>Voornaam <span class="required">*</span></label><br>
                                <input type="text" name="firstName" value="'.$_POST['firstName'].'"><br>
                                '.$messages['errors']['firstName'].'
                                <label>Achternaam</label><br>
                                <input type="text" name="lastName" value="'.$_POST['lastName'].'"><br>
                                '.$messages['errors']['lastName'].'
                                <label>Email <span class="required">*</span></label><br>
                                <input type="mail" name="email" value="'.$_POST['email'].'"><br>
                                '.$messages['errors']['emailAddress'].'
                                <label>Datum <span class="required">*</span></label><br>
                                <input type="text" name="date" id="datePicker" value="'.$_POST['date'].'"><br>
                                '.$messages['errors']['reservationDate'].'
                                <label>Tijd <span class="required">*</span></label><br>
                                <select name="reservationTime">
                                    <option>---</option>
                                </select></br>
                                '.$messages['errors']['reservationTime'].'
                                <label>Aantal Gasten <span class="required">*</span></label><br>
                                <select name="numberGuests"></select><br>
                                '.$messages['errors']['numberGuests'].'
                                <label>Bericht</label><br>
                                <textarea name="message">'.$_POST['message'].'</textarea><br>
                                '.$messages['errors']['message'].'
                                <input type="submit" name="send" value="Verzend">
                            </form>
                        </section>
                        <section>
                            <h3>Reserveer gemakkelijk en snel online.</h3>
                            <p>Reserveren is nu online mogelijk.<br>
                            Vul het formulier in en maak een reservering bij de brasserie</p>
                            <p>Bij reserveringen van meer dan 12 personen wordt gevraagd telefonisch contact op te nemen.<br>
                            Deze reserveringen kunnen helaas niet online gemaakt worden</p>
                            <p>Vind de <a href="'.ROOT.'pages/contact">Contactgegevens</a></p>
                            <img src="'.ROOT.'img/bar_tap.min.jpg" alt="bar tap">
                        </section>
                    </main>'
            ));
        }
        public function menu(){
            $this -> model('menucard');
            $data=$this -> model -> getData();
            $this -> view('pages/home_test', array(
                'scripts'=>'
                    <link rel="stylesheet" type="text/css" href="'.ROOT.'css/style_menu.css">
                    ',
                'meta'=>'
                    <title>Menukaart | '.SITENAME.'</title>
                    <meta name="robots" content="follow, index">
                    <meta name="description" content="Vind de Horeaca menukaart online">
                    ',
                'header'=>'
                    <header id="headerMenuCard"></header>',
                'body'=>'
                    <main>
                        <section>
                            <div id="title">
                                <h1>Menukaart</h1>
                            </div>
                            <div id="menucard" class="aligned">
                                <div>
                                    <section class="menuTitle">
                                        <h3>Gerechten</h3>
                                    </section>
                                    <section>
                                        <h3>Ontbijt</h3>
                                        '.$data['food']['breakfast'].'
                                    </section>
                                    <section>
                                        <h3>Lunch</h3>
                                        '.$data['food']['lunch'].'
                                    </section>
                                    <section>
                                        <h3>Diner</h3>
                                        '.$data['food']['diner'].'
                                    </section>
                                    <section>
                                        <h3>Dessert</h3>
                                        '.$data['food']['dessert'].'
                                    </section>
                                </div>
                                <div>
                                    <section class="menuTitle">
                                        <h3>Dranken</h3>
                                    </section>
                                    <section>
                                        <h3>Fris</h3>
                                        '.$data['drinks']['soda'].'
                                    </section>
                                    <section>
                                        <h3>Alcohol</h3>
                                        '.$data['drinks']['alcohol'].'
                                    </section>
                                    <section>
                                        <h3>Warme dranken</h3>
                                        '.$data['drinks']['hot_beverages'].'
                                    </section>
                                </div>
                            </div>
                            <div>
                                <section id="downloadSection">
                                    <p>De menukaart is nu ook te downloaden</p>
                                    <a href="'.ROOT.'pages/pdf">Ga naar de PDF menukaart</a>
                                    <a href="'.ROOT.'pages/pdf" download>Download de PDF menukaart</a>
                                </section>
                            </div>
                        </section>
                    </main>'
            ));
        }
        public function contact(){
            $this -> model('contacter');
            $messages=$this -> model -> getMessages();
            $this -> view('pages/home_test', array(
                'scripts'=>'
                    <link rel="stylesheet" type="text/css" href="'.ROOT.'css/style_form.css">',
                'meta'=>'
                    <title>Contact | '.SITENAME.'</title>
                    <meta name="robots" content="follow, index">
                    <meta name="description" content="Neem contact op met Horeaca, of vul ons contactformulier in">
                    ',
                'header'=>'
                    <header id="headerContact"></header>',
                'body'=>'
                    <main class="aligned">
                        <div>
                            <section>
                                <h1>Contact</h1>
                                <p>Heeft u verder contact nodig?<br>
                                Vul ons formulier in voor uw vraag/mededeling.<br>
                                <strong>Horeaca</strong> is natuurlijk ook telefonisch te bereiken</p>
                            </section>
                            <section>
                                <p>Telefoon: +31-655-5842-61<br>
                                Email: info@horeaca.nl</p>
                            </section>
                            <section>
                                '.$messages['success'].'
                                <form action="'.ROOT.'pages/contact" method="post">
                                    <label>Naam <span class="required">*</span></label><br>
                                    <input type="text" name="fullName" value="'.$_POST['fullName'].'"><br>
                                    '.$messages['errors']['fullName'].'
                                    <label>Telefoon</label><br>
                                    <input type="number" name="phoneNumber" value="'.$_POST['phoneNumber'].'"><br>
                                    '.$messages['errors']['phoneNumber'].'
                                    <label>Email <span class="required">*</span></label><br>
                                    <input type="mail" name="email" value="'.$_POST['email'].'"><br>
                                    '.$messages['errors']['emailAddress'].'
                                    <label>Bericht</label><br>
                                    <textarea name="content">'.$_POST['content'].'</textarea><br>
                                    <input type="submit" name="send" value="Verzend">
                                </form>
                            </section>
                        </div>
                        <section id="openingsSchedule">
                            <h3>Openingstijden</h3>
                            <table>
                                <tr><td>Maandag</td><td>Gesloten</td></tr>
                                <tr><td>Dinsdag</td><td>11:00 - 21:00</td></tr>
                                <tr><td>Woensdag</td><td>11:00 - 21:00</td></tr>
                                <tr><td>Donderdag</td><td>11:00 - 21:00</td></tr>
                                <tr><td>Vrijdag</td><td>11:00 - 21:00</td></tr>
                                <tr><td>Zaterdag</td><td>11:00 - 21:00</td></tr>
                                <tr><td>Zondag</td><td>11:00 - 18:00</td></tr>
                            </table>
                            <p>Horeaca is op feestdagen gesloten</p>
                        </section>
                    </main>'
            ));
        }
        public function pdf(){
            $this -> model('pdf');
        }
        public function updateJson(){
            $this -> model('update_json');
        }
    }
?>