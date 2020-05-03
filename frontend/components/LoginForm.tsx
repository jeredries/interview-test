import React from 'react';
import Fetch from 'isomorphic-unfetch';
import ErrorField from "./ErrorField";
import "./LoginForm.scss";

interface LoginFormProps {
    handleConnected: Function;
}

interface LoginFormState {
    email: string;
    password: string;
    error: boolean;
}

class LoginForm extends React.Component<LoginFormProps, LoginFormState> {
    state: LoginFormState;

    constructor(props: any) {
        super(props);
        this.state = {
            email: '',
            password: '',
            error: false
        };

        this.handleChange = this.handleChange.bind(this);
        this.handleSubmit = this.handleSubmit.bind(this);
    }

    handleChange = (event: any): void => {
        const target = event.target;

        this.setState<never>({
            [target.name]: target.value,
        });
    }

    handleSubmit = (event: any): void => {
        event.preventDefault();

        Fetch('http://127.0.0.1:8000/login', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                'email': this.state.email,
                'password': this.state.password
            })
        }).then(r => {
            if (r.ok) {
                // get token + redirect to home
                this.setState<never>({
                    'error': false,
                });
                r.json().then(result => {
                    this.props.handleConnected(result['token']);
                });
            } else {
                // display message error
                this.setState<never>({
                    'error': true,
                });
            }
        })
    }

    render() {
        return (
            <div className="Login-form">
                <p className="Title">
                    <img className="Logo" src="/img/icons/logo.svg" alt="easyblue logo" />
                </p>
                <form onSubmit={this.handleSubmit}>
                    <div className="Group">
                        <label>
                            Adresse e-mail
                            <input name="email" type="email" value={this.state.email} onChange={this.handleChange} />
                        </label>
                    </div>
                    <div className="Group">
                        <label>
                            Mot de passe
                            <input name="password" type="password" value={this.state.password} onChange={this.handleChange} />
                        </label>
                    </div>
                    {this.state.error && <ErrorField message="Nom d'utilisateur ou mot de passe incorrect" />}
                    <button className="Submit" type="submit">CONNEXION</button>
                    <button type="button">MOT DE PASSE OUBLIÉ</button>
                </form>
            </div>
        );
    }
}

export default LoginForm;
