## Front-end test with Typescript and next.js

This interview aims at evaluating your current typescript skills and/or your learning capabilities.

### Goals

* Clone this repo and install its dependencies (`npm install` or `yarn`)
* Run `npm run dev` or `yarn dev` and visit [http://localhost:3000]( http://localhost:3000) to see the result
* Set up the styling solution of your choice (styled-components, SASS, any framework...) or simply use next's [CSS-in-JS](https://nextjs.org/docs/basic-features/built-in-css-support#css-in-js)
* Create two simple pages : login and dashboard

### API routes

* Use the [API routes](https://nextjs.org/docs/api-routes/introduction) feature of next.js in order to create a simple `/login` POST route
* This route accepts `email` and `password` as body parameters
* When sending the proper credentials (`user@domain.tld` / `123456789`), the API should respond `{ valid: true }` as JSON

### Login page

![](https://i.imgur.com/D7ena7N.jpg)

* Create a simple form with email and password (you can use [formik](https://github.com/jaredpalmer/formik) and [yup](https://github.com/jquense/yup) but a simple form is also fine !)
* When submitting the form, send a request to your API route using either the `fetch` API or any package of your choice ([axios](https://github.com/axios/axios)...)
* If credentials are wrong, display a simple error message of your choice
* If they're valid, [navigate](https://nextjs.org/docs/api-reference/next/router) to the dashboard page

### Dashboard page

![](https://i.imgur.com/A1EGb52.png)

* The goal here is to show off your react skills
* Write react components as you see fit, make sure they are simple and efficient
* You can directly write the data into your components, or keep it separate as a JSON file (or even as an API endpoint that you fetched !)
* Your typescript code is the most important here, but a nice integration is also welcomed

### Notes

* Clone this repo and push it into one of your own on GitHub or GitLab (any host is fine)
* All assets shown in the screenshots are available in `public/img/icons`, feel free to use them (*you might need to set up SVG support by yourself !*)
* Be creative ! You can add some features if you want and/or want to display some of your skills
