const puppeteer = require("puppeteer");

const getNews = async (req, res) => {
  const {
    query: { url },
  } = req;

  console.log("Url ---> ", url)

  try {
    const browser = await puppeteer.launch();
    const page = await browser.newPage();

    await page.goto(url);

    // Get news title and detail links
    const news = await page.evaluate(() => {
      const newsCard = Array.from(document.querySelectorAll("h3"));
      const data = newsCard.map((card) => ({
        title: card.innerText,
        href: card.querySelector("a").href,
      }));
      return data;
    });

    const response = [];

    for (let i = 0; i < news.length; i++) {
      const newsItem = news[i];
      // Go to news detail page.
      await page.goto(newsItem.href);
      // Get news detail
      const article = await page.evaluate(() => {
        const paragraph = Array.from(document.querySelectorAll(".bbc-hhl7in"));
        const allParagraphs = paragraph.reduce(
          (acc, currentItem) => acc + currentItem.innerText,
          ""
        );
        return allParagraphs;
      });

      // Calculate total words of the news detail 
      wordsCount = countWords(article);

      const responseObject = {
        title: newsItem.title,
        word_count: wordsCount,
      };

      response.push(responseObject)
    }
    
    res.status(200).json(response);
  } catch (error) {
    console.log(error)
    res.status(400).send({error: "Somethings went wrong..."})
  }
};

function countWords(paragraph) {
  const words = paragraph.trim().split(/\s+/);
  return words.length;
}

module.exports = { getNews };
