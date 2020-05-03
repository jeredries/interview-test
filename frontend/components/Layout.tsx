import Header from "./Header";
import Footer from "./Footer";
import Head from "next/head";
import "./Layout.scss";
import "./index.scss";

const Layout: React.FC = (props) => (
    <>
        <div className="Layout">
            <Head>
                <title>Easyblue: test frontend</title>
                <link rel="icon" href="/favicon.ico" />
                <meta name="viewport" content="width=device-width, initial-scale=1" />
                <meta charSet="utf-8" />
            </Head>

            <Header />

            <div className="Content">{props.children}</div>

            <Footer />
        </div>
    </>
);

export default Layout;