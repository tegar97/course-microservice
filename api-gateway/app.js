var express = require("express");
var path = require("path");
var cookieParser = require("cookie-parser");
var logger = require("morgan");
require("dotenv").config();
var indexRouter = require("./routes/index");
var usersRouter = require("./routes/users");
const mediaRouter = require("./routes/media");
const chapterRouter = require("./routes/chapters");

const courseRouter = require("./routes/courses");
const orderRouter = require("./routes/order");
const paymentRouter = require("./routes/order");
const verifyToken = require("./middleware/verifyToken");
const refreshTokenRouter = require("./routes/refreshTokens");
const mentorsRouter = require("./routes/mentors");

var app = express();

app.use(logger("dev"));
app.use(express.json({ limit: "50mb" }));
app.use(express.urlencoded({ extended: false, limit: "50mb" }));
app.use(cookieParser());
app.use(express.static(path.join(__dirname, "public")));

app.use("/", indexRouter);
app.use("/users", usersRouter);
app.use("/courses", courseRouter);
app.use("/chapters", verifyToken, chapterRouter);
app.use("/media", mediaRouter);
app.use("/orders", orderRouter);
app.use("/payment", paymentRouter);
app.use("/refresh-tokens", refreshTokenRouter);
app.use("/mentors", verifyToken, mentorsRouter);

module.exports = app;
