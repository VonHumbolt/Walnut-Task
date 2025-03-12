const express = require("express");
const cors = require('cors')

const app = express();
const PORT = 3000

app.use(cors())
app.use(express.urlencoded({ extended: true }));

const newsRoute = require('./routes/newsRoute')

app.use("/api/news/", newsRoute)

app.listen(PORT, () => {
    console.log("Listening on port -> ", PORT)
})