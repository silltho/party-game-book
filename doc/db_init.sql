DELETE FROM games_tags;
DELETE FROM games_materials;
DELETE FROM tags;
DELETE FROM materials;
DELETE FROM games;
DELETE FROM users;

ALTER SEQUENCE tag_id_seq RESTART;
ALTER SEQUENCE material_id_seq RESTART;
ALTER SEQUENCE game_id_seq RESTART;
ALTER SEQUENCE user_id_seq RESTART;

INSERT INTO tags VALUES(nextval('tag_id_seq'), 'Kartenspiel');
INSERT INTO tags VALUES(nextval('tag_id_seq'), 'Trinkspiel');
INSERT INTO tags VALUES(nextval('tag_id_seq'), 'Brettspiel');
INSERT INTO tags VALUES(nextval('tag_id_seq'), 'Ballspiel');
INSERT INTO tags VALUES(nextval('tag_id_seq'), 'Elektronisches Spiel');
INSERT INTO tags VALUES(nextval('tag_id_seq'), 'Fantasy Spiel');
INSERT INTO tags VALUES(nextval('tag_id_seq'), 'Gedächnis Spiel');
INSERT INTO tags VALUES(nextval('tag_id_seq'), 'Teams');
INSERT INTO tags VALUES(nextval('tag_id_seq'), 'Sport');
INSERT INTO tags VALUES(nextval('tag_id_seq'), 'Tisch');


INSERT INTO materials VALUES(nextval('material_id_seq'), 'Doppeldeutsche Karten');
INSERT INTO materials VALUES(nextval('material_id_seq'), 'Pokerkarten');
INSERT INTO materials VALUES(nextval('material_id_seq'), 'Stifte und Papier');
INSERT INTO materials VALUES(nextval('material_id_seq'), 'Spielfiguren');
INSERT INTO materials VALUES(nextval('material_id_seq'), 'Würfel');
INSERT INTO materials VALUES(nextval('material_id_seq'), 'Post-it');
INSERT INTO materials VALUES(nextval('material_id_seq'), 'Fußball');
INSERT INTO materials VALUES(nextval('material_id_seq'), 'Handball');
INSERT INTO materials VALUES(nextval('material_id_seq'), 'Volleyball');

INSERT INTO users VALUES(nextval('user_id_seq'), 'fb', '1231887666829360', 'Thomas Siller');

INSERT INTO games (id, gamename, description, recommended_age, min_player_count, max_player_count, average_playtime, creation_date, user_id) VALUES (nextval('game_id_seq'), 'Shithead', '<p>Shithead ist ein Stichspiel, bei dem die Spieler versuchen ihre Karten m&ouml;glichst schnell loszuwerden. Der Verlierer erh&auml;lt meistens eine Strafe, er muss z.&nbsp;B. Tee machen oder wenigstens als n&auml;chster die Karten mischen und geben.</p>
<h4 id="players">Spieler und Karten</h4>
<p>Es k&ouml;nnen zwei bis f&uuml;nf Personen mitspielen. Das Spiel funktioniert mit mindestens drei Spielern am besten.</p>
<p>F&uuml;r das Spiel wird das &uuml;bliche Kartenspiel mit 52 Karten verwendet. Die Karten bilden vom h&ouml;chsten bis zum niedrigsten Wert die folgende Reihenfolge: 2, A, K, D, B, 10. . . , 2 (die Zweien sind hoch <strong>und</strong> niedrig - siehe unten).</p>
<h4 id="deal">Karten geben</h4>
<p>Der erste Geber wird nach dem Zufallsprinzip bestimmt. Das Geben erfolgt nach jedem Spiel im Uhrzeigersinn.</p>
<ol>
<li>Der Geber teilt an jeden Spieler eine Reihe von drei verdeckten Karten aus, jeweils reihum die erste, dann die zweite, dann die dritte.</li>
<li>Der Geber teilt an jeden Spieler drei aufgedeckte Karten aus, jeweils reihum eine nach der anderen, sodass sie die verdeckten Karten bedecken.</li>
<li>Der Geber teilt an jeden Spieler drei weitere Karten aus, die die Spieler auf die Hand nehmen und ansehen, jeweils reihum eine nach der anderen.</li>
</ol>
<p>Die &uuml;brigen Karten werden verdeckt abgelegt und bilden einen Nachziehstapel.</p>
<p>Vor dem Beginn des Spiels kann jeder Spieler beliebig viele Karten aus seinem Blatt gegen seine aufgedeckten Karten austauschen. Ein Spieler darf niemals die verdeckten Karten ansehen, bevor sie gespielt werden. (Die Spieler nehmen gew&ouml;hnlich aufgedeckte Karten mit niedrigeren Werten in ihr Blatt auf).</p>
<h4 id="play">Ausspielen der Karten</h4>
<p>Es beginnt die Person, die die erste aufgedeckte 3 erh&auml;lt. Wenn keine 3 aufgedeckt wird, spielt derjenige die erste Karte aus, der eine Drei in seinem Blatt ansagt. Wenn keine 3 an ein Blatt ausgegeben wurde, wird dasselbe Verfahren f&uuml;r die erste 4 angewendet, usw. falls n&ouml;tig.</p>
<p>Der beginnende Spieler erzeugt einen Ablagestapel auf dem Tisch, indem er aus seinem Blatt eine beliebige Anzahl von Karten mit demselben Rang ausspielt. Danach zieht er die entsprechende Anzahl an Karten aus dem Nachziehstapel &nbsp;um sein Blatt wieder auf drei Karten aufzuf&uuml;llen. Im Uhrzeigersinn die Reihe um muss jeder Spieler entweder eine Karte oder einen Satz gleichwertiger Karten aufgedeckt auf den Ablagestapel legen oder falls er nicht legen kann den Stapel aufnehmen. Die ausgespielte/n Karte/n muss/m&uuml;ssen den gleichen oder einen h&ouml;heren Rang haben als die zuvor ausgespielten. Dies geht so weiter, eventuell mehrmals um den Tisch herum, bis schlie&szlig;lich ein Spieler nicht mehr willens oder in der Lage ist, den zuvor ausgespielten Karten gleichzukommen oder sie zu &uuml;bertreffen. Wenn Ihr Blatt nach dem Ausspielen weniger als drei Karten umfasst, m&uuml;ssen Sie es sofort durch Ziehen aus dem Stapel auff&uuml;llen, sodass Sie wieder drei Karten haben. Wenn zu wenig Karten auf dem Stapel liegen, ziehen Sie alle, die da sind. Wenn keine Karten mehr auf dem Stapel liegen, geht das Spiel weiter wie zuvor, aber ohne das Auff&uuml;llen.</p>
<p>Wenn Sie an der Reihe sind und keine Karte ausspielen k&ouml;nnen oder wollen, m&uuml;ssen Sie alle Karten des Ablagestapels aufnehmen und Ihrem Blatt hinzuf&uuml;gen. Wenn Sie die Karten aufnehmen, spielen Sie diesmal nicht aus, sondern Ihr linker Nachbar, der als n&auml;chster an der Reihe ist, beginnt einen neuen Ablagestapel, indem er eine beliebige Karte oder einen Satz von gleichwertigen Karten ausspielt. Das Spiel geht dann weiter wie zuvor.</p>
<p>Solange Sie noch Karten auf der Hand haben, wenn Sie an der Reihe sind, d&uuml;rfen Sie nicht die Karten ausspielen, die auf dem Tisch liegen; Sie k&ouml;nnen in dieser Runde nur die Karten ausspielen, die Sie in der Hand halten.</p>
<h4 id="210">Zweien, Zehnen und Abr&auml;umen des Stapels</h4>
<p><strong>Zweien</strong> d&uuml;rfen immer auf jede Karte ausgespielt werden, und jede Karte darf auf eine Zwei ausgespielt werden.</p>
<p>Eine <strong>Zehn</strong> darf in jeder beliebigen Runde ausgespielt werden, ganz gleich, welche Karte oben auf dem Ablagestapel liegt (oder sogar, wenn der Ablagestapel leer ist). Wenn eine Zehn ausgespielt wird, wird der Ablagestapel aus dem Spiel genommen, und <strong>derselbe Spieler</strong>, der die Zehn ausgespielt hat, ist nochmals an der Reihe, indem er eine beliebige Karte oder Satz von gleichwertigen Karten ausspielt, um einen neuen Ablagestapel zu er&ouml;ffnen.</p>
<p>Wenn ein Spieler einen <strong>Satz von vier Karten des selben Ranges</strong> auf dem Ablagestapel vervollst&auml;ndigt (entweder durch Ausspielen aller vier Karten auf einmal oder indem er den Zug des Vorg&auml;ngers erg&auml;nzt), wird der gesamte Stapel aus dem Spiel genommen, und <strong>derselbe Spieler</strong>, der den Vierer vervollst&auml;ndigt hat, ist erneut an der Reihe und spielt eine beliebige Karte oder einen Satz gleicher Karten aus, um einen neuen Ablagestapel zu er&ouml;ffnen.</p>
<h4 id="endgame">Das Endspiel</h4>
<p>Wenn Sie in der Runde zum ersten Mal an der Reihe sind und keine Karten auf der Hand haben (weil Sie in der letzten Runde alle ausgespielt haben und der Nachziehstapel leer war), k&ouml;nnen Sie jetzt Ihre aufgedeckten Karten ausspielen. Wenn Sie Ihre aufgedeckten Karten ausspielen und keine Karte des gleichen oder h&ouml;heren Ranges als die vom vorigen Spieler ausgespielte(n) Karte(n) ausspielen k&ouml;nnen (oder ausspielen wollen), f&uuml;gen Sie dem Stapel eine Ihrer aufgedeckten Karten hinzu und nehmen dann den gesamten Stapel auf. Dann ist der n&auml;chste Spieler an der Reihe einen neuen Ablagestapel zu beginnen, indem er eine beliebige Karte oder einen Satz gleicher Karten ausspielt. Nachdem Sie den Stapel aufgenommen haben, m&uuml;ssen Sie in den folgenden Runden diese Karten ausspielen, bis Sie wieder alle Karten aus Ihrer Hand losgeworden sind. Danach k&ouml;nnen Sie wieder Ihre Tischkarten ausspielen.</p>
<p>Wenn Sie alle Ihre aufgedeckten Tischkarten ausgespielt haben und keine Karten mehr in der Hand haben, spielen Sie Ihre verdeckten Karten blind aus, indem Sie eine Karte umdrehen und auf den Stapel legen, wenn Sie an der Reihe sind. Wenn die umgedrehte Karte spielbar ist, wird sie ausgespielt, und der n&auml;chste Spieler muss ihr gleichkommen oder sie &uuml;bertreffen. Wenn die von Ihnen umgedrehte Karte nicht spielbar ist (weil sie niedriger als die zuvor ausgespielte ist), nehmen Sie den ganzen Stapel einschlie&szlig;lich der umgedrehten Karte auf. Dann ist der n&auml;chste Spieler an der Reihe einen neuen Ablagestapel zu beginnen. Nachdem Sie den Stapel &uuml;bernommen haben, m&uuml;ssen Sie in den folgenden Runden die Karten aus Ihrer Hand ausspielen, bis Sie wieder alle Karten losgeworden sind und Ihre n&auml;chste Tischkarte umdrehen k&ouml;nnen.</p>
<p>Wenn Sie Ihr Blatt und Ihre Tischkarten vollst&auml;ndig losgeworden sind, haben Sie es erfolgreich vermieden, Verlierer zu sein und scheiden aus dem Spiel aus. Wenn Sie Ihre letzte Tischkarte umwenden, k&ouml;nnen Sie nur dann ausscheiden, wenn diese die vorige Karte schl&auml;gt (oder wenn Sie sie auf einen leeren Ablagestapel legen). Wenn Sie Ihre letzte Karte aufdecken und diese nicht spielbar ist, m&uuml;ssen Sie sie zusammen mit dem gesamten Stapel aufnehmen. W&auml;hrend Mitspieler ausscheiden, spielen die verbleibenden Spieler weiter. Der letzte Spieler, der noch Karten hat, ist der Verlierer (auch <strong>Shithead </strong>genannt). Dieser Spieler muss beim n&auml;chsten Spiel geben und Tee machen (oder irgendeine andere Aufgabe ausf&uuml;hren, die f&uuml;r das allgemeine Wohlbefinden der Gruppe sorgt).</p>', 1, 2, 20, 15, CURRENT_TIMESTAMP , 1);
INSERT INTO games_tags VALUES (1, 1);
INSERT INTO games_materials VALUES (1, 2);

INSERT INTO games (id, gamename, description, recommended_age, min_player_count, max_player_count, average_playtime, creation_date, user_id) VALUES (nextval('game_id_seq'), 'Wer bin ich?', '<p>Jeder Mitspieler wird von einem anderen zu einer bekannten Pers&ouml;nlichkeit ernannt. Er bekommt einen kleinen Klebezettel mit dem entsprechenden Namen auf die Stirn, ohne selbst zu wissen, wer er sein soll. Durch geschicktes Nachfragen - es sind nur Ja und Nein als Antwort erlaubt - muss nun jeder herausfinden, wer er ist.</p>
<p>Lautet die Antwort Ja, darf derselbe Spieler eine weitere Frage stellen. Bei Nein ist der n&auml;chste dran. Es gewinnt, wer als Erstes err&auml;t, wen er darstellen soll.</p>', 6, 2, 20, 30, '2016-05-07 18:17:17.456979', 1);
INSERT INTO games_tags VALUES (2, 7);
INSERT INTO games_materials VALUES (2, 6);

INSERT INTO games (id, gamename, description, recommended_age, min_player_count, max_player_count, average_playtime, creation_date, user_id) VALUES (nextval('game_id_seq'), 'Mau-Mau', '<h5><strong>Spielziel</strong></h5>
<p>Gewonnen hat der Spieler, der als erstes seine letzte Karte abgelegt hat.</p>
<h5><strong>Spielanleitung</strong></h5>
<p>Jeder Spieler erh&auml;lt zu Beginn 5 Karten. Die &uuml;brigen Karten werden als Stapel verdeckt in die Mitte gelegt. Die erste Karte wird aufgedeckt daneben gelegt. Der Spieler links vom Kartengeber beginnt. Er hat 3 M&ouml;glichkeiten:</p>
<ul>
<li>Der Spieler legt auf die Karte dieselbe Farbe. <strong>Beispiel</strong>: Er legt auf eine Pik 10 eine Pik Dame.</li>
<li>Der Spieler legt dieselbe Karte in einer anderen Farbe. <strong>Beispiel</strong>: Er legt auf eine Pik 10 eine Karo 10.</li>
<li>Der Spieler legt einen Buben, egal in welcher Farbe.</li>
</ul>
<p>Kann ein Spieler keine passende Karte spielen, so nimmt er eine Karte vom Stapel. Wenn die Karte passt,&nbsp; kann er sie ablegen, ansonsten ist der n&auml;chste Spieler dran.</p>
<h5><strong>Bedeutungen bestimmter Karten</strong></h5>
<p>Einige Karten haben besondere Bedeutungen:</p>
<ul>
<li>Wenn eine 7 f&auml;llt, muss der n&auml;chste Spieler 2 Karten aufnehmen. Es sei denn, er kann eine 7 nachlegen. Dann muss der folgende Spieler 4 Karten (2+2) aufnehmen. Es sei denn, er kann auch eine 7 nachlegen ...</li>
<li>Wenn eine 8 f&auml;llt, muss der n&auml;chste Spieler aussetzen.</li>
<li>Wenn eine 9 f&auml;llt, erfolgt ein Richtungswechsel. Die Runden gehen nicht mehr im Uhrzeigersinn, sondern dagegen, bis die n&auml;chste 9 f&auml;llt.</li>
<li>Wenn ein Bube gespielt wird, darf sich der Spieler eine Farbe w&uuml;nschen. Ein Bube kann zu jeder Zeit gespielt werde. Beispiel: Wenn eine Herz 10 liegt, kann der Spieler, der dran ist, einen Pik Buben spielen und sich Kreuz w&uuml;nschen.</li>
</ul>
<h5><strong>Spielende</strong></h5>
<p>Das Spiel endet, wenn ein Spieler seine letzte Karte ablegt. Die anderen Spieler z&auml;hlen die Werte ihrer Karten zusammen und bekommen sie als Minuspunkte angeschrieben.</p>
<h5><strong>Kartenwerte</strong></h5>
<p>Die Karten haben dieselben Werte wie beim Skat.</p>
<ul>
<li>Ass: 11</li>
<li>Zehn: 10</li>
<li>K&ouml;nig: 4</li>
<li>Dame: 3</li>
<li>Bube: 2</li>
<li>Neun: 0</li>
<li>Acht: 0</li>
<li>Sieben: 0</li>
</ul>', 6, 2, 5, 30, '2016-05-12 08:32:47.334487', 1);
INSERT INTO games_tags VALUES (3, 1);
INSERT INTO games_materials VALUES (3, 2);

INSERT INTO games (id, gamename, description, recommended_age, min_player_count, max_player_count, average_playtime, creation_date, user_id) VALUES (nextval('game_id_seq'), 'Stadt, Land, Fluss', '<p><strong>Vorbereitung</strong> <strong>&nbsp;</strong> Auf dem Blatt-Papier legen die Spieler eine Tabelle an mit drei Spalten: Stadt, Land und Fluss.</p>
<p><strong>Das Spiel beginnt</strong> &nbsp; Wer anf&auml;ngt wird ausgelost oder einfach bestimmt. Ab dann geht es linksherum, also im Uhrzeigersinn.</p>
<p>&nbsp;</p>
<p><strong>Spielprinzip (Ablauf)</strong><br /> <br /> <strong><em>1. Buchstabe finden</em></strong></p>
<p>Der Spieler der an der Reihe ist geht in Gedanken das Alphabet durch &ndash; sprich er sagt in Gedanken das ABC auf. Der Spieler links neben ihm sagt irgendwann Stopp. Nun muss der Spieler, der in Gedanken das Alphabet (ABC) durchgegangen ist, den Buchstaben bei dem er angekommen ist, laut sagen. &nbsp; &nbsp;</p>
<p><strong><em>2. Stadt, Land, Fluss aufschreiben</em></strong></p>
<p>Jetzt sind alle Spieler gefordert, auch der Spieler, der den Buchstaben laut gesagt hat. Die Spieler m&uuml;ssen eine Stadt, ein Land und einen Fluss aufschreiben.<br /> Wichtig: Stadt, Land, und Fluss m&uuml;ssen mit dem laut gesagten Buchstaben als Anfangsbuchstaben beginnen. &nbsp; &nbsp;</p>
<p><strong><em>3. Stadt, Land, Fluss aufgeschrieben</em></strong></p>
<p>Hat ein Spieler eine Stadt, ein Land und ein Fluss, ruft er fertig. Dann z&auml;hlt er laut bis zehn und ruft Stopp. Nun m&uuml;ssen alle Spieler aufh&ouml;ren zu schreiben und die Stifte weglegen. &nbsp; &nbsp;</p>
<p><strong><em>4. Punktevergabe</em></strong></p>
<p>Dann werden die Punkte vergeben. &nbsp; &nbsp;</p>
<ul>
<li>5 Punkte:&nbsp;<br /><span class="Apple-style-span" style="-webkit-text-decorations-in-effect: none;">Haben mindestens zwei Spieler die gleiche Stadt (Land, Fluss) aufgeschrieben, erhalten diese Spieler jeweils 5 Punkte.</span></li>
<li>10 Punkte:&nbsp;<br /><span class="Apple-style-span" style="-webkit-text-decorations-in-effect: none;">Hat ein Spieler eine Stadt (Land, Fluss) aufgeschrieben, die sonst keiner hat, erh&auml;lt dieser Spieler 10 Punkte.</span></li>
<li>20 Punkte:&nbsp;<br /><span class="Apple-style-span" style="-webkit-text-decorations-in-effect: none;">Hat ein Spieler als Einziger eine Stadt (Land, Fluss) aufgeschrieben, erh&auml;lt dieser Spieler 20 Punkte. Dies ist immer dann der Fall, wenn alle anderen Spieler zu dem Anfangsbuchstaben keine Stadt (Land, Fluss) finden konnten.</span></li>
</ul>
<p><strong><em>5. Auswertung</em></strong></p>
<p>Alle Spieler schreiben ihre Punkte direkt zu ihrer Stadt (Land, Fluss). Wer die meisten Punkte bei einem Buchstaben erzielt hat, hat den Buchstaben gewonnen. <br /> Weiter geht es dann wieder mit <strong><em>1. Buchstabe finden</em></strong> &nbsp; Die Anzahl der Runden ist frei w&auml;hlbar, oder man spielt einfach, bis man keine Lust mehr hat. &nbsp; &nbsp; <strong><em>6. Gewinner</em></strong> Es gibt zwei Stadt, Land, Fluss Gewinner: &nbsp; &nbsp;</p>
<ul>
<li>Buchstaben-Gewinner<br /><span class="Apple-style-span" style="-webkit-text-decorations-in-effect: none;">Wer die meisten Buchstaben gewonnen hat, ist der Stadt, Land, Fluss Buchstaben-Gewinner.</span></li>
<li>Gesamt-Gewinner<br /><span class="Apple-style-span" style="-webkit-text-decorations-in-effect: none;">Wer insgesamt die meisten Punkte erzielt hat, ist der Stadt, Land, Fluss Gesamt-Gewinner.</span></li>
</ul>', 6, 2, 12, 20, '2016-05-11 22:10:36.103536', 1);
INSERT INTO games_tags VALUES (4, 1);
INSERT INTO games_materials VALUES (4, 2);

INSERT INTO games (id, gamename, description, recommended_age, min_player_count, max_player_count, average_playtime, creation_date, user_id) VALUES (nextval('game_id_seq'), 'Buben-Ziehen', '<p><span class="normalfont">Die Karten werden gemischt und verkehrtherum in die Mitte gelegt.<br />Nun zieht jeder Spieler abwechselnd eine Karte und deckt sie auf.</span></p>
<p><span class="normalfont"><br />Wenn ein Bube gezogen wird, gibt es eine "Aktion":<br /></span></p>
<ol>
<li><span class="normalfont">Bube: Getr&auml;nk einsch&auml;nken (wieviel und welches alkoholhaltige Getr&auml;nk, bleibt dem Spieler &uuml;berlassen)</span></li>
<li><span class="normalfont">Bube: antrinken (soviel man m&ouml;chte - ACHTUNG: es darf NICHT leer getrunken werden!!!)</span></li>
<li><span class="normalfont">Bube: austrinken (das Glas leer trinken, egal wieviel nach dem 2. Buben noch &uuml;brig gelassen wurde)</span></li>
<li><span class="normalfont">Bube: ausziehen (ein Kleidungsst&uuml;ck muss abgelegt werden)</span></li>
</ol>', 16, 2, 5, 20, '2016-05-13 11:11:19.543861', 1);
INSERT INTO games_tags VALUES (5, 1);
INSERT INTO games_tags VALUES (5, 2);
INSERT INTO games_materials VALUES (5, 2);
INSERT INTO games_materials VALUES (5, 1);

INSERT INTO games (id, gamename, description, recommended_age, min_player_count, max_player_count, average_playtime, creation_date, user_id) VALUES (nextval('game_id_seq'), 'Fatsch', '<p><span class="normalfont"><strong>Spielablauf:</strong></span><br /> <span class="normalfont">1.Karten werden gemischt.<br />2.Gemischter Stapel wird auf den Tisch gelegt.<br />3.Erster Spieler zieht eine Karte.<br />4.N&auml;chster Spieler zieht eine Karte.<br />5. usw.<br /><br />Kartenerkl&auml;rung:<br />Ass: Derjenige darf eine Regel erstellen. <br /> z.B.: Jeder der einen Selbstlaut nennt, muss trinken<br />K&ouml;nig: Alle m&uuml;ssen trinken<br />Ober: Mann darf 3 Schl&uuml;cke verteilen<br />Unter: Mann darf 2 Schl&uuml;cke verteilen<br />10er: Mann darf einen Schluck verteilen*<br />9er: Mann muss selbst 3 Schl&uuml;cke nehmen<br />8er: Mann muss selbst 2 Schl&uuml;cke nehmen<br />7er: Mann muss selbst 1 Schl&uuml;cke nehmen<br />6er: Niemand muss tinken.</span></p>', 16, 2, 10, 20, '2016-05-13 11:07:25.008934', 1);
INSERT INTO games_tags VALUES (6, 1);
INSERT INTO games_tags VALUES (6, 2);
INSERT INTO games_materials VALUES (6, 2);