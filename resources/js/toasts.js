import Toast from 'more-toast';

const config = {
    position: 'top-right',
    in: 'slide-right',
    out: 'slide-right',
    showTime: 4000,
    dir: 'rtl',
    canClose: true,
    progressBar: true,
    pauseOnHover: true,
};

const successStyle = {
    icon: 'success',
    fontFamily: 'shabnam',
    iconColor: 'rgb(147 197 253)',
    closeIconColor: 'black',
    progressBarGradient: 'linear-gradient(to right top, rgb(219 234 254), rgb(147 197 253)',
};

const errorStyle = {
    icon: 'error',
    fontFamily: 'shabnam',
    iconColor: '#a90303',
    closeIconColor: 'black',
    progressBarGradient: 'linear-gradient(to right top, #d40404, #a90303)',
};


const successToast = new Toast(config, successStyle);
const errorToast = new Toast(config, errorStyle);

export { successToast, errorToast }
