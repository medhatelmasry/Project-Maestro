function userValidate(values) {
    let errors = {}

    if (!values.userName.trim()) {
        errors.userName = "Username cannot be empty.";
    }

    let emailRegex = /\S+@\S+\.\S+/;
    if (!values.email.trim()) {
        errors.email = "Email cannot be empty.";
    } else if (!values.email.match(emailRegex)) {
        errors.email = "Email not in proper format. Email should be in the form example@example.com";
    }

    let passwordRegex = /^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{7,}$/;
    if (!values.password.trim()) {
        errors.password = "Password cannot be empty.";
    } else if (values.password.length <= 6) {
        errors.password = "Password must be more than 6 characters.";
    } else if (!values.password.match(passwordRegex)) {
        errors.password = "Password must contain at least 1 uppercase letter, 1 lowercase letter, 1 number, and 1 special character.";
    }

    if (!values.firstName.trim()) {
        errors.firstName = "First name cannot be empty.";
    }

    if (!values.lastName.trim()) {
        errors.lastName = "Last name cannot be empty.";
    }

    return errors;
}

export default userValidate;