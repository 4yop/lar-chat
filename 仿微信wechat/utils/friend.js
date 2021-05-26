import url from './url';

import { http_request } from './http_request';


const get_friends_list = function () {
    let parame = {
        url : url.friendList,
    };
    http_request(parame);
};


export { get_friends_list };
