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

Här är redovisningstexten



Kmom05
-------------------------

Här är redovisningstexten



Kmom06
-------------------------

Här är redovisningstexten



Kmom07-10
-------------------------

Här är redovisningstexten
