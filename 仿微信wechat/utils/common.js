
const getUserAvatar = (user_id)=>{

    let name = parseInt(user_id)%4;

    return require(`@/static/image/avatar/${name}.jpg`);
};




export {getUserAvatar}
