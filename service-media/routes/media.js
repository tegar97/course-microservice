const express = require("express");
const router = express.Router();
const base64Img = require("base64-img");
const isBase64 = require("is-base64");
const { Media } = require("../models");

router.post("/", (req, res, next) => {
  const image = req.body.image;

  if (!isBase64(image, { mimeRequired: true })) {
    return res.status(400).json({
      status: "error",
      message: "invalid base64",
    });
  }

  base64Img.img(image, "./public/images", Date.now(), async (err, filepath) => {
    if (err) {
      return res.status(400).json({
        status: "error",
        message: err.message,
      });
    }

    const fileName = filepath.split("\\").pop().split("/").pop();

    const media = await Media.create({
      image: `image/${fileName}`,
    });

    return res.json({
      status: "success",
      data: {
        media: media.id,
        image: `${req.get("host")}/images/${fileName}`,
      },
    });
  });
});

module.exports = router;
