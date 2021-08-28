const express = require("express");
const mediaHandler = require("./handler/media");
const router = express.Router();
const { APP_NAME } = process.env;
/* GET users listing. */
router.post("/", mediaHandler.create);
router.get("/", mediaHandler.getAll);
router.delete("/:id", mediaHandler.destory);
module.exports = router;
