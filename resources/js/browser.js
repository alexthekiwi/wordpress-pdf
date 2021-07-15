const puppeteer = require('puppeteer');

//here we convert the json with all the conversion options to a JavaScript object
const request = JSON.parse(process.argv[2]);

const callChrome = async () => {
    let browser;
    let page;

    try {

        // let's launch headless chrome
        browser = await puppeteer.launch();

        // here we create a new page
        page = await browser.newPage();

        // build up options, omitted in this blog post

        // and here we set the url of that page and pass all the requested options
        await page.goto(request.url, requestOptions);

        await browser.close();
    } catch (exception) {
        if (browser) {
            await browser.close();
        }

        process.exit(1);
    }
};

// do the magic!
callChrome();
