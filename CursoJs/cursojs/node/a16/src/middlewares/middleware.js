exports.middlewareGlobal = (req, res, next) => {
    res.locals.umaVariavelLocal = 'valor val local';
    next();
};

exports.outroMiddleware = (req, res, next) => {
    next();
};