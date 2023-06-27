const getFilteredTransactions = async (items) => {

    const { data } = await axios.post(route("transactions.filter"), items);

    return data;
}

export { getFilteredTransactions }
