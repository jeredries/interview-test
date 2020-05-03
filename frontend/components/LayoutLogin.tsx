import Head from "next/head";

import "./LayoutLogin.scss";

interface LayoutProps {

}

const LayoutLogin: React.FC<LayoutProps> = (props) => (
    <>
        <div className="LayoutLogin">
            <Head>
                <title>Easyblue: test frontend</title>
                <link rel="icon" href="/favicon.ico" />
                <meta name="viewport" content="width=device-width, initial-scale=1" />
                <meta charSet="utf-8" />
            </Head>

            <div className="Content">
                {props.children}
            </div>

            <img className="ImgHenry" src={'/img/icons/henry-chill.png'} alt='logo' />
        </div>
    </>
);

export default LayoutLogin;