/**
 * 
 * @param {string} path 
 * @returns 
 */
export function ResolvePath(path){
    const PROJECT_NAME = window.location.pathname.split("/")[1];
    const ORIGIN = window.location.origin;
    const PORT = window.location.port;
    const HOST = window.location.host;
    let _stylesheetsoutdir_ = null;

    if (HOST == "localhost") {
        return _stylesheetsoutdir_ = ORIGIN + `/${PROJECT_NAME}/${path}`;
    } else if (HOST !== "localhost" && PORT !== "") {
        return _stylesheetsoutdir_ = ORIGIN + `:${PORT}/${path}`;
    } else {
        return _stylesheetsoutdir_ = ORIGIN + `/${path}`;
    }
}

export function Api(path){
    return ResolvePath(`assets/api/${path}`);
}