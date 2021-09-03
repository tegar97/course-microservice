const express = require("express");
const ReviewHandlerRouter = require("./handler/Reviews");
const router = express.Router();
/* GET users listing. */
router.post("/", ReviewHandlerRouter.create);
router.put("/:id", ReviewHandlerRouter.update);
router.delete("/:id", ReviewHandlerRouter.destroy);

module.exports = router;
