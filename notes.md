# this is md file for writing what i will need to save




# Main site -> Install (pokud není site nainstalovaná)
TODO: 
*DTB*
1. Automatické vytvoření databázových tabulek s parametry
2. Automatické doplnění pro každý parametr jestli si tento parametr zvolil
*PHP*
1. Kontrola jednotlivých parametrů pro stránku a jejich vzájemná funkčnost
2. Po vytvoření a doplnění DTB doplní data do první tabulky, která bude obsahovat základní informace (jméno obchodu a další)
3. Vytvoření admin uživatele => PHP odkáže na admin-create.php

# Install -> User Create Site (admin create)
Stránka bude sloužit k vytvoření jakéhokoliv uživatele (v tomto případě ale přijde s parametry pro vytvoření admina => MAIN ADMINA)
TODO:
*DTB*
1. Pokud není DTB pro admin vytvořena, tak jí vytvoří
*PHP*
1. Po odeslání formuláře na registraci uživatele se zančeným polem typu admin tyto údaje zkontroluje, pokračuje dál pouze pokud kontrola proběhne úspěšně 
2. Zašifrované heslo pošle do dtb spolu s user-name
