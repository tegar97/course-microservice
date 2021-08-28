module.exports = (sequelize, DataTypes) => {
  const refreshToken = sequelize.define(
    "RefreshToken",
    {
      id: {
        type: Sequelize.INTEGER,
        primaryKey: true,
        autoIncrement: true,
        allowNull: false,
      },
      token: {
        type: Sequelize.TEXT,
        allowNull: false,
      },
      user_id: {
        type: Sequelize.INTEGER,
        allowNulll: false,
      },
      createdAt: {
        fields: "created_at",
        type: Sequelize.DATE,
        allowNull: false,
      },
      updatedAt: {
        fields: "updated_at",
        type: Sequelize.DATE,
        allowNull: false,
      },
    },
    {
      tableName: "users",
      timestamps: true,
    }
  );

  return refreshToken;
};
