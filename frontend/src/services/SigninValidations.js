import Validations from "@/services/Validations";

export default class SigninValidations {
    constructor(email, password) {
        this.email = email;
        this.password = password;
    }

    checkValidations() {
        let errors = [];

        if (!Validations.checkEmail(this.email)) {
            // errors.push("Endereço de email inválido");
            errors['email'] = "Endereço de email inválido";
        }

        if (!Validations.minLength(this.password, 6)) {
            // errors.push("A senha deve ter pelo menos 6 caracteres");
            errors['password'] = "A senha deve ter pelo menos 6 caracteres";
        }

        return errors;
    }
}