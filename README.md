# i244-projekt
Aine "Võrgurakendused I" projekt: kinoseansside piletite broneerimine

## Ülesande kirjeldus
Ülesandeks on luua lihtne kinoseansside piletite broneerimise süsteem, kus registreeritud kasutaja saab vaadata olemasolevaid kinoseansse ning broneerida pileteid

## Lisatingimused
  * Kasutaja saab registreerida endale uue konto
  * Kasutaja saab end sisse logida

## Lahendus
  * Registreeritud kasutaja saab näha kõiki kinoseansse ühe nimekirjana
  * Nupul "Broneerige pilet" klikkides avaneb kinoseansi detailvaade
  * Detailvaates näeb kinoseansi kirjeldust ja ka broneeringu tegemise vormi: tekstilahter soovitud piletite arvuga ning nupp broneeringu kinnitamiseks. Broneering kinnitatakse ainult juhul, kui kinoseanns ei ole veel alanud ja kinoseansile on vabu kohti.
  * Kinoseansside nimekirjas on näha ka vabu kohti kinoseanssidele.

## Märkused
Andmebaasis on järgmised tabelid:

1. Kasutajate tabel:  'Kasutaja_id', 'Kasutajanimi', 'Parool', 'Lisatud'
1. Kinoseansside tabel: 'Kinoseansi_id', 'Kinoseansi_nimetus', 'Algusaeg', 'Kohti_kokku'
1. Broneeringute tabel: 'Broneeringu_id', 'Kinoseansi_id_b', 'Broneeritud_piletite_hulk'
