var express = require("express");
var path = require("path");
var cookieParser = require("cookie-parser");
var logger = require("morgan");
require("dotenv").config();
var indexRouter = require("./routes/index");
var usersRouter = require("./routes/users");
const mediaRouter = require("./routes/media");
const chapterRouter = require("./routes/chapters");
const lessonRouter = require("./routes/lessons");
const courseRouter = require("./routes/courses");
const orderPaymentRouter = require("./routes/orderPayments");
const refreshTokenRouter = require("./routes/refreshTokens");
const mentorsRouter = require("./routes/mentors");
const imageCourseRouter = require("./routes/imageCourses");
const MyCoureseRouter = require("./routes/myCourse");
const ReviewsRouter = require("./routes/Reviews");
const webHookRouter = require("./routes/webhook");

const verifyToken = require("./middleware/verifyToken");
const can = require("./middleware/permisson");
var app = express();

app.use(logger("dev"));
app.use(express.json({ limit: "50mb" }));
app.use(express.urlencoded({ extended: false, limit: "50mb" }));
app.use(cookieParser());
app.use(express.static(path.join(__dirname, "public")));

app.use("/", indexRouter);
app.use("/users", usersRouter);
app.use("/courses", courseRouter);
app.use("/chapters", verifyToken, can("admin"), chapterRouter);
app.use("/lessons", verifyToken, can("admin"), lessonRouter);
app.use("/image-courses", verifyToken, can("admin"), imageCourseRouter);
app.use("/my-courses", verifyToken, can("admin", "student"), MyCoureseRouter);
app.use("/reviews", verifyToken, can("admin", "student"), ReviewsRouter);
app.use("/webhook", webHookRouter);

app.use("/media", verifyToken, can("admin", "student"), mediaRouter);
app.use("/orders", verifyToken, can("admin", "student"), orderPaymentRouter);
app.use("/refresh-tokens", refreshTokenRouter);
app.use("/mentors", verifyToken, can("admin"), mentorsRouter);

module.exports = app;
