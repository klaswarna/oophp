---
---
Redovisning
=========================



Kmom01
-------------------------

Det var ett tag sedan jag sysslade med PHP förra gången och jag har under sommaren enbart sysslat med några programmeringsprojekt i node, så vissa saker hade hamnat i glömska, men å andra sidan har vissa begrepp och tankesätt hunnit landa så på det hela taget gick det rätt bra att hoppa in på objekten i PHP. Det påminner i allt väsentligt om objekt i Python eller javascript, men har fulare syntax och tycks vara mera ”uppstyrt” än motsvarande i javascript.

Som ofta i dbwebbkurserna var det mycket kvantitet i get-post-uppgiften och lite rörigt att hitta all information om vad som krävdes. Det slutade med att jag snodde den mesta koden, men jag fattade allt och kunde jämföra det snodda med hur jag själv tänkt från början och enkelt inse att mina egna lösningar hade blivit mycket omständligare. Det var lärorikt när allt kom omkring och det gick bra att ta till sig.

Beträffande me-sidan så flöt det mesta på. Fick dock stanna och joxa på några ställen, men det löste sig efter lite googlande. Bra med genomgångsvideorna. De visar hur man gör och lite grand varför. Mycket bra. Förra gången (förra hösten) hade jag stora problem med att greppa github, men nu var det inte så knepigt.

Dagens speciella lärdom för mig brukar ofta vara något som inte direkt var relaterat till det huvudsakliga innehållet. Så även idag. Jag fick 100%-ig kläm på vitsen med value och name i submit-typen i form i HTML (en högst trivial detalj, som jag ändå inte riktigt fattat på ett år). Att man kan använda olika ”knappar” som man submittar med och sen kolla vilken som tryckts genom att kolla om namnet är SET bland post eller get-variablerna på sidan man landar.



Kmom02
-------------------------

Det här kursavsnittet var inte jätteomfattande, men ändå ”lönnsvårt” såsom att överföra gissa-spelet i ramverket. Det var inget som borde orsaka några större komplikationer, inga nya koncept att fatta, men det var ändå lite klurigt att hitta rätt bland alla mappar och filer i Anax och att inte glömma någon detalj. Videorna var bra (även om de inte riktigt stämde med aktuell version av Anax). Det som skapade mest förvirring innan jag fick klart för mig var att ”return true” under inga omständigheter kunde tas bort om routen skulle funka ordentligt.

Det här med att skriva kod utanför och innanför ramverket känns inte helt obekant numera, eftersom vi har viss vana från express. Principiellt bör man väl ha all kod om möjligt inom ramverket så vet man att allt ligger på sin plats. Nackdelen kan väl vara om man har förhållandevis lite logik och innehåll på en sida och då ändå behöva dela upp den.

Det där med UML-modellering känns som en tröskel, svår att komma över, men har man väl gjort sig besvären med att konstruera snygga klassdiagram är det nästan bara att tuta och köra sen. Smart med phpDocumentator och make doc att man på det viset i efterhand kan få en överblick på kodstrukturen. Särskilt om man behövt modifiera klasserna i efterhand, så man inte behöver göra om modelleringen igen från början eller hålla sig till felaktiga modeller i sin dokumentation.

Today I learnt det smarta sättet att ”byta ut” bilder via css genom att egentligen bara zooma in olika delar av en och samma bild som i tärningsspelet. Smart!




Kmom03
-------------------------

Att testa kod med annan kod är inget jag har brukat göra hittils men det är inte helt nytt eftersom vi gjorde det litegrand i en av python-kurserna.

Jag begriper intellektuellt att det verkar vettigt, men har ännu inte uppnåt den nivån då det har praktisk nytta (med det menar jag att mina program är för enkla och fulkodade för att tidsvinsten och säkerheten med enhetstestning skall vara mätbar. Men i takt med att mitt kodande förhoppningsvis utvecklas, kommer behovet av att testa det systematiskt också göra det, varför det är bra att komma in i det tänket så snart som möjligt.

Lite begrepp att reda ut:

White box testing innebär att man som testare har tillgång till källkoden av ett programavsnitt och testar att den inre strukturen av dito fungerar och agerar som förväntat.

Vid black box testing behöver testaren emellertid inte ha tillgång till källkoden utan bara känna till de publika gränssnitten och testa att programmet fungerar i det avseendet, d.v.s. att med rätt värden in så skall rätt värden ut genereras, hur det sker internt behöver och kan man inte bry sig om.

Grey box testing är ett mellanting mellan det två ovanstående.

Vid positiva tester skapar man testfall som man vill ska fungera och ge ett visst resultat. Man kan också skapa negativa tester, varvid man vill att ett program inte skall fungera vid givna indata, kanske för att testa om exceptions kastas t.ex. eller helt enkelt för att testa att vid givet läge skall utfallet INTE bli av ett visst slag.

Tärninggspelet var en mycket tuff uppgift, för det är svårt att lära sig nya saker och vara kreativ med dem på samma gång och dessutom behöva uppfylla massa specifika krav i HUR det skall programmeras (t.ex. i det här fallet ”minimal kod i routern”).

Jag tänkte först börja programmera lite improviserat, använda mig av tidigare gjorda kodsnuttar i kursen och justera efterhand. Jag insåg snart att det inte vore en bra lösning, varpå jag istället började med att konstruera klasser i uml-diagram, från mindre till större. Jag skapade en tärningsklass, en för tärningshand, spelrunda, spelare och spelbord, där alla komponerats av tidigare klasser. Förhållandena mellan Spelrunda och Spelare kändes inte helt optimerat så jag strök spelrunda-klassen.

Sen fick klassen Spelbord sköta all logik. För att spara information mellan sidomladdningarna skickas en Spelbord-instans med i SESSION liksom två instanser av Spelare som Spelbord är beroende av. De val som dator eller människa gör vid varje drag skickas med en POST-variabel.
Datorn är så pass intelligent att om den har t.ex. 90 poäng och får 12 poäng väljer den att stanna framför att försöka igen. I övrigt styrs dess beslut enbart av slumpen. Vill man ha fler än 5 tärningar är det bara att ändra en parameter i rad 32 i Spelare.php. Jag hann emellertid inte lägga in detta som ett val i själva användargränssnittet.

Jag lyckades få 100% kodtäckning när jag enhetstestade tärningsspelet, MEN det blir inte alltid så eftersom slumpen spelar in. Olika utfall på tärningarna samt datorns AI-val påverkar. Jag har därför ibland gjort flera liknande test efter varandra som kan ge olika utfall och ökar sannolikheten för att all kod testas. Så testa flera gånger och ha tur (bifogade en bild i doc/ som visar att jag faktiskt uppnådde 100% vid ett tillfälle).

Om jag måste nämna en TIL för detta kmom kan det kanske vara att man måste tänka på att inte bara skicka med ett objekt i SESSION utan även de objekt som det förra innehåller om så är fallet.



Kmom04
-------------------------

Trait verkar praktiskt när man inte kan ärva från flera klasser. Begreppet interface kändes lite ”varför då?” i början, men efterhand som man blir mer strukturerad i sitt programmerande kan det nog ha sin plats om inte annat som ett slags ritning, eller specifikation för hur kompatibla klasser skall konstrueras.

Datorns intelligens i tärningsspelet ökade ytterligare litet. Tidigare fattade datorn bara att stanna om omgångens poäng plus tidigare totalpoäng överskridit 100, men fr.o.m. nu väljer den att 1) alltid försöka igen om omgångens poäng var mindre än 15 (d.v.s. litet att förlora), 2) alltid stanna om den har minst 50 poäng mer än motståndaren (smart att vara försiktig då).

I mitt fall gjorde användandet av ramverkets get, post o.s.v. det ingen större skillnad då jag redan hanterade alla post och session endast i routern och inte i enskilda klasser. När man väl kommit in i ramverkets struktur är det naturligtvis smidigare att använda sig av ramverkets funktioner i så stor utsträcknings som möjligt. Det hela påminner lite om hur vi programmer i express och mithril.

Förra kursmomentet hade jag mycket jox med make test inne i ramverket, men denna gång handlade det bara om att lägga till ytterligare en enstaka testklass med några testfunktioner, och jag fick hög kodtäckning även nu. Ibland 100%, men eftersom vissa testklasser är beroende på klassernas inneboende slump blir det ibland några procent mindre. Kanske korkade test av mig, men good enough i nuläget anser jag. Ibland gör jag medvetna test som skall faila eftersom de ger så komplexa returvärden som blir jobbiga att jämföra med någon av de testmetoder i phpunit som jag begripit såhär långt.

Dagens til är att om man skall förlänga en array med en annan array i PHP med array_push så måste man skriva … framför arrayen man vill utöka med. (märklig konstruktion i php!?!)




Kmom05
-------------------------

PDO-övningen denna gång var en litet annorlunda övning. Det var snarare ett litteraturstudium än en övning, men det var tydligt och pedagogiskt och lärorikt.

Det gick lite sådär att få in koden i ramverket. Det är svårt att orientera sig i det. Tillsynes samma filer ligger i tillsynes likadana strukturer på flera ställen i ramverket utan att man har riktigt koll på var, hur och varför.

En sak som jag hade särskilda bekymmer med var att veta och kontrollera hur långt ut i ”working directory” man befann sig. En viss länk funkade i ett visst läge, men inte om den importerades i en annan fil. Jag kom endast runt det med fullösningar denna gång. Detsamma gäller redirectande i största allmänhet.

Jag gjorde endast basstrukturen i filmdatabasen, men försökte få den användarvänlig i alla fall. Koden blev inte särskilt snygg heller. Men i sammanhanget handlade det för mig om att fatta principerna, få det att funka och bli klar. Snyggare och effektivare kod får det förhoppningsvis bli på slutuppgiften, då vi har lite mer tid på oss. För att bortförklara mig ytterligare, måste jag tillägga att jag varit sjuk i veckan och under två dagar var jag minimalt produktiv, men jag har – peppar, peppar - inte varit sjuk annars sedan jag påbörjade programmeringsstudierna förra hösten.

Dagens til: hur man kan logga in på studentservern med ”dbwebb login” som betyder samma som ”ssh studentakronym@bth.och.så.vidare”




Kmom06
-------------------------

Hur gick det att jobba med klassen för filtrering och formatting av texten?

Det gick rätt bra (förutom det där felmeddelandet för markdown, som gick att trixa bort). Men det mesta var ju bara att sno och skriva av.

Berätta om din klasstruktur och kodstruktur för din lösning av webbsidor med innehåll i databasen.

Jag använde mig av ContentController såsom påbörjades på föreläsningen och byggde vidare på det. Föreläsningen sista kursmomentet var väldigt tydlig och pedagogisk.

Hur känner du rent allmänt för den koden du skrivit i din me/redovisa, vad är bra och mindre bra? Ser du potential till refactoring av din kod och/eller behov av stöd från ramverket?

Nja, den egna koden är hittills inget vidare och den kunde definitivt förbättrats, särskilt före kmom06. Jag har haft massa fulkod, både i själva vyerna och i routerna, som med fördel borde skrivits i klasser i stället. Men det har varit svårt att veta hur och vad som skall kapslas in. I mitt första försök av tärningsspelet gjorde jag ALLT i klasser, så det enda som gjordes i routern var att samla in en post-variabel och i vyn anropa en metod uppdateraSpelplan(), men det blev inte heller bra p.g.a. för mycket cyklisk komplexitet i en av klasserna enligt valideringsprogrammen.

Det handlar väl om att titta på exempel och tips, triala och errora en massa på egen hand för att så småningom få en känsla för vad som skall läggas i klasser och hur i lagom portioner.

Gällande stöd från ramverket är det förmodligen så, att när man provat en däri inbyggd funktion en gång, kommer man alltid att använda den därefter, men det är svår i början att veta vad man alls skulle kunna göra bättre innan man har koll på användbara funktioner. Det är trots befintlig dokumentation svår att greppa i förväg. Det är också rörigt att ha koll på vad alla olika typer av filer ligger i ramverket. Men precis som med express och node som blir mer och mer överblickbart ju fler gånger man använt det, lär det väl bli så även med anax och php så småningom.

I det sista kursmomentet försökte jag använda klasser och funktioner men gjorde ful-php i edit-formulärens filter-val, som jag vet med fördel relativt enkelt kunde gjorts med en array eller nåt objekt, men ibland blir det för mycket att både ha en relativ komplex funktionalitet i kursmomentet och snygg kod på kort tid. Då måste man prioritera det förra.

Vilken är din TIL för detta kmom?

Jag känner att jag börjar få en mental bild av hur man kan använda klasser genom att injecta ett annat objekt. Jag tror det är början på att kunna tänka generellt objektorienterat på ett rationellt sätt. Annars blir det för krångligt.




Kmom07-10
-------------------------

Här är redovisningstexten
