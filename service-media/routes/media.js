const express = require("express");
const router = express.Router();
const base64Img = require("base64-img");
const isBase64 = require("is-base64");
router.post("/", (req, res, next) => {
  const image = req.body.image;

  if (!isBase64(image, { mimeRequired: true })) {
    return res.status(400).json({
      status: "error",
      message: "invalid base64",
    });
  }

  return res.status(200).json({
    status: "sukses",
    message: "sukses",
  });
});

module.exports = router;
