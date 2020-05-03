import React from 'react';
import Activity from "./Activity";
import UserInfo from "./UserInfo";
import Fetch from 'isomorphic-unfetch';
import "./Cards.scss";

interface CardsProps {
    token: string;
}

interface CardsStates {
    activities: Array<{
        id: string,
        time: string,
        title: string,
        description: string
    }>;

    userInfos: {
        idCompany: Number,
        company: string,
        address: string,
        cp: Number,
        city: string,
        country: string
    };
}

class Cards extends React.Component<CardsProps, CardsStates> {
    state: CardsStates;
    props: CardsProps;

    constructor(props: any) {
        super(props);
        this.state = {
            activities: [],
            userInfos: {
                idCompany: null,
                company: '',
                address: '',
                cp: null,
                city: '',
                country: ''
            }
        };
    }

    componentDidMount() {
        Fetch('http://127.0.0.1:8000/index', {
            method: 'GET',
            headers: {
                'Accept': 'application/json',
                'X-AUTH-TOKEN': this.props.token,
            },
        }).then(r => {
            if (r.ok) {
                r.json().then(result => {

                    this.setState<never>({
                        'activities': result.activities,
                        'userInfos': result.userInfos
                    });
                });
            }
        });
    }

    render() {
        const { activities, userInfos } = this.state;
        const { idCompany, company, address, cp, city, country } = userInfos;
        return (
            <>
                <div className="Card">
                    <img src="/img/icons/user.svg" alt="user" />
                    Moi et ma société
                    <UserInfo idCompany={idCompany} company={company} address={address} cp={cp} city={city} country={country} />
                </div>
                <div className="Card">
                    <img src="/img/icons/event.svg" alt="activity" />
                    Mes dernières activitées
                    {
                        activities.map(({ id, time, title, description }) => (
                            <Activity id={id} time={new Date(time)} title={title} description={description} key={id} />
                        ))
                    }
                </div>
            </>
        )
    }
}

export default Cards;
