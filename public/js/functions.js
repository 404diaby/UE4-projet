

/*

export function testMatch(word, pattern) {
    let regexPattern =''


    ^ → Début du mot de passe
    (?=.*[a-z]) → Au moins une minuscule
    (?=.*[A-Z]) → Au moins une majuscule
    (?=.*\d) → Au moins un chiffre
    (?=.*[@$!%*?&]) → Au moins un caractère spécial (@, $, !, %, *, ?, &)
    [A-Za-z\d@$!%*?&]{12,} → Au moins 12 caractères, composés de lettres, chiffres et symboles
    $ → Fin du mot de passe

    switch (pattern) {
        case 'password': regexPattern = "^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{12,}$"
            break
        case 'email': regexPattern = ""
            break

        default:
            regexPattern = ''
    }
    const regex = new RegExp(regexPattern);
    return regex.test(word);
}

*/


