import Validations from "@/services/Validations";

export default class SignupValidations {
    constructor(name, email, password) {
        this.email = email;
        this.password = password;
        this.name = name;
    }

    checkValidations() {
        let errors = [];

        if (!Validations.checkEmail(this.email)) {
            // errors.push("Invalid email address");
            errors['email'] = "Invalid email address";
        }

        if (!Validations.minLength(this.name, 3)) {
            // errors.push("Name must be at least 3 characters");
            errors['name'] = "Name must be at least 3 characters";
        }

        if (!Validations.minLength(this.password, 6)) {
            // errors.push("Password must be at least 6 characters");
            errors['password'] = "Password must be at least 6 characters";
        }

        return errors;
    }
}