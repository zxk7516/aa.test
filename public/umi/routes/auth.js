import Redirect from 'umi/redirect';

export default (props) => {
    const auth = Math.ceil(Math.random() * 100) % 2;

    return (
        <div>
            {auth ? <Redirect to="/login" /> :
                <div>
                    <div>PrivateRoute (routes/PrivateRoute.js)</div>
                    {props.children}
                </div>}
        </div>
    )
        ;
}
