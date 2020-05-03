import React from 'react';
import LayoutLogin from "../components/LayoutLogin";
import LoginForm from "../components/LoginForm";
import Layout from "../components/Layout";
import Cards from "../components/Cards";

interface Props {

}

interface States {
    isConnected: boolean;
    token: string;
}

class Index extends React.Component<Props, States> {
    state: States;
    props: Props;

    constructor(props: any) {
        super(props);
        this.state = {
            isConnected: false,
            token: '',
        };
    }

    componentDidUpdate() {
        localStorage.setItem('_token', this.state.token);
    }

    componentDidMount() {
        const token = localStorage.getItem('_token')
        if (token) {
            this.setState<never>({
                'isConnected': true,
                'token': token,
            });
        }
    }

    handleConnected = (token: string): void => {
        this.setState<never>({
            'isConnected': true,
            'token': token,
        });
    }

    render() {
        const { isConnected } = this.state;
        if (isConnected) {
            return (
                <Layout>
                    <div className="ContainerHome">
                        <h1>Bienvenue sur votre espace personnel </h1>
                        <p>Retrouvez si dessous la liste des contrats auquel vous avez souscrit</p>
                        <div className="Cards">
                            <Cards token={this.state.token} />
                        </div>
                    </div>
                </Layout>
            )
        } else {
            return (
                <LayoutLogin>
                    <LoginForm handleConnected={this.handleConnected}/>
                </LayoutLogin>
            )
        }
    }
}

export default Index;