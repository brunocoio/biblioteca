const bcryptjs = require('bcryptjs');

module.exports = {
    up: async(queryInterface) => queryInterface.bulkInsert(
        'users', [{
            nome: 'admin',
            email: 'admin@email.com',
            password_hash: await bcryptjs.hash('123456', 8),
            created_at: new Date(),
            updated_at: new Date(),
        }, {
            nome: 'admin2',
            email: 'admin2@email.com',
            password_hash: await bcryptjs.hash('123456', 8),
            created_at: new Date(),
            updated_at: new Date(),
        }, {
            nome: 'admin3',
            email: 'admin3@email.com',
            password_hash: await bcryptjs.hash('123456', 8),
            created_at: new Date(),
            updated_at: new Date(),
        }], {},
    ),

    down: () => {},
};
