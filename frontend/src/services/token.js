import cookie from "js-cookie";

const Authorization = `${cookie.get('token')}`
export default Authorization;
