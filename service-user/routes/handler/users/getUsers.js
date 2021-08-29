const { User } = require("../../../models");

module.exports = async (req, res) => {
  const user = await User.findAll({
    attributes: ["id", "name", "email", "role", "profession"],
  });

  return res.json({
    status: "success",
    data: user,
  });
};
