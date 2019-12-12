
// Toast types
const TOAST = Object.freeze({
    'INFO': 'info',
    'SUCCESS': 'success',
    'WARNING': 'warning',
    'ERROR': 'error',
});

// Displays a toast with the given message and type
function toast(message, type)
{
    switch (type)
    {
        case TOAST.INFO:
            M.toast({html: message, classes: TOAST.INFO});
            break;
        case TOAST.SUCCESS:
            M.toast({html: message, classes: TOAST.SUCCESS});
            break;
        case TOAST.WARNING:
            M.toast({html: message, classes: TOAST.WARNING});
            break;
        case TOAST.ERROR:
            M.toast({html: message, classes: TOAST.ERROR});
            break;
        default:
            M.toast({html: message});
            break;
    }
}
