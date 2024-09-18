import Validations from "@/services/Validations";

export default class SigninValidations {
    constructor(email, password) {
        this.email = email;
        this.password = password;
    }

    checkValidations() {
        let errors = [];

        if (!Validations.checkEmail(this.email)) {
            errors['email'] = "Invalid email address";
        }

        if (!Validations.minLength(this.password, 6)) {
            errors['password'] = "Password must have at least 6 characters";
        }

        return errors;
    }
}